import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import session from 'express-session';
import methodOverride from 'method-override';
import {
  users,
  specialitesList,
  centresList,
  appointments,
  cabinetRequests,
  consultations,
  documents
} from './data.js';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;
const HOST = '0.0.0.0';

// View engine setup
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Static assets
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(methodOverride('_method'));

// Session configuration
app.use(
  session({
    secret: process.env.SESSION_SECRET || 'medilink-secret-session-key',
    resave: false,
    saveUninitialized: false,
    cookie: { maxAge: 24 * 60 * 60 * 1000 }
  })
);

// Flash messages and common locals
app.use((req, res, next) => {
  if (!req.session.messages) {
    req.session.messages = {};
  }
  res.locals.messages = { ...req.session.messages };
  req.session.messages = {}; // clear for next request

  res.locals.user = req.session.user || null;
  res.locals.currentPath = req.path;
  next();
});

function setFlash(req, type, message) {
  if (!req.session.messages) req.session.messages = {};
  req.session.messages[type] = message;
}

// ----------------------------------------------------
// Public Routes
// ----------------------------------------------------

app.get('/', (req, res) => {
  res.render('welcome', {
    title: 'Accueil',
    specialites: specialitesList
  });
});

app.get('/medecins', (req, res) => {
  let filtered = users.filter((u) => u.role === 'medecin');
  const q = (req.query.q || '').trim().toLowerCase();
  const ville = (req.query.ville || '').trim().toLowerCase();

  if (q) {
    filtered = filtered.filter(
      (m) =>
        m.name.toLowerCase().includes(q) ||
        (m.specialite && m.specialite.toLowerCase().includes(q))
    );
  }
  if (ville) {
    filtered = filtered.filter(
      (m) => m.ville && m.ville.toLowerCase().includes(ville)
    );
  }

  res.render('medecins', {
    title: 'Médecins disponibles',
    medecins: filtered,
    query: req.query
  });
});

app.get('/specialites', (req, res) => {
  res.render('specialites', {
    title: 'Spécialités médicales',
    specialites: specialitesList
  });
});

app.get('/specialites/:slug', (req, res) => {
  const spec = specialitesList.find((s) => s.slug === req.params.slug);
  if (spec) {
    return res.redirect(`/medecins?q=${encodeURIComponent(spec.name)}`);
  }
  res.redirect('/specialites');
});

app.get('/centres-de-sante', (req, res) => {
  res.render('centres-sante', {
    title: 'Centres de santé',
    centres: centresList
  });
});

app.get('/aide', (req, res) => {
  res.render('aide', {
    title: 'Aide & FAQ'
  });
});

app.get('/a-propos', (req, res) => {
  res.render('apropos', {
    title: 'À propos de Médilink'
  });
});

app.get('/inscrire-cabinet', (req, res) => {
  res.render('cabinets-register', {
    title: 'Inscrire un cabinet'
  });
});

app.post('/inscrire-cabinet', (req, res) => {
  const { nom_hopital, adresse, telephone, email } = req.body;
  cabinetRequests.push({
    id: cabinetRequests.length + 1,
    nom_hopital,
    adresse,
    telephone,
    email,
    date: new Date().toISOString()
  });
  setFlash(
    req,
    'success',
    `Votre demande d'inscription pour "${nom_hopital}" a été transmise avec succès ! Notre équipe vous contactera sous 24h.`
  );
  res.redirect('/inscrire-cabinet');
});

app.get('/connexion-cabinet', (req, res) => {
  res.redirect('/login?role=admin');
});

// ----------------------------------------------------
// Authentication Routes
// ----------------------------------------------------

app.get('/login', (req, res) => {
  const role = req.query.role || 'patient';
  let defaultEmail = 'patient@medilink.com';
  if (role === 'medecin') defaultEmail = 'mensah@medilink.com';
  if (role === 'admin') defaultEmail = 'admin@medilink.com';

  res.render('login', {
    title: 'Connexion',
    role,
    email: defaultEmail
  });
});

app.post('/login', (req, res) => {
  const { email, password, role } = req.body;
  let user = users.find((u) => u.email.toLowerCase() === (email || '').toLowerCase().trim());

  // Allow easy login for prototype/preview testing if user exists or fallback
  if (!user && role) {
    user = users.find((u) => u.role === role);
  }

  if (user) {
    req.session.user = user;
    setFlash(req, 'success', `Bienvenue, ${user.name} !`);
    if (user.role === 'admin') return res.redirect('/admin/dashboard');
    if (user.role === 'medecin') return res.redirect('/medecin/rendez-vous');
    return res.redirect('/patient/dashboard');
  }

  setFlash(req, 'error', 'Identifiants invalides. Veuillez réessayer.');
  res.redirect('/login?role=' + (role || 'patient'));
});

app.post('/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/');
  });
});

app.get('/register/patient', (req, res) => {
  res.render('register-patient', {
    title: 'Inscription Patient'
  });
});

app.post('/register/patient', (req, res) => {
  const { name, email, password, phone, dob, address } = req.body;
  if (!name || !email || !password) {
    setFlash(req, 'error', 'Veuillez remplir tous les champs obligatoires.');
    return res.redirect('/register/patient');
  }

  const existing = users.find((u) => u.email.toLowerCase() === email.toLowerCase().trim());
  if (existing) {
    setFlash(req, 'error', 'Cette adresse email est déjà enregistrée.');
    return res.redirect('/register/patient');
  }

  const newUser = {
    id: users.length + 1,
    name,
    email: email.trim(),
    password,
    role: 'patient',
    phone: phone || '',
    dob: dob || '',
    address: address || '',
    created_at: new Date().toISOString().slice(0, 10)
  };
  users.push(newUser);

  req.session.user = newUser;
  setFlash(req, 'success', 'Votre compte a été créé avec succès ! Bienvenue sur Médilink.');
  res.redirect('/patient/dashboard');
});

// ----------------------------------------------------
// Appointments (Prise de rendez-vous)
// ----------------------------------------------------

app.get('/rendez-vous/nouveau', (req, res) => {
  const doctors = users.filter((u) => u.role === 'medecin');
  const prefillDoctor = req.query.doctor || '';

  res.render('rendezvous-create', {
    title: 'Nouveau rendez-vous',
    doctors,
    prefillDoctor
  });
});

app.post('/rendezvous', (req, res) => {
  const { doctor_id, scheduled_at, reason, patient_name } = req.body;
  const doctor = users.find((u) => u.id == doctor_id);

  let currentPatient = req.session.user;
  if (!currentPatient) {
    currentPatient = {
      id: 99,
      name: patient_name || 'Patient Visiteur',
      role: 'patient'
    };
  }

  const newAppointment = {
    id: appointments.length + 1,
    user_id: currentPatient.id,
    doctor_id: Number(doctor_id),
    doctor_name: doctor ? doctor.name : 'Médecin',
    doctor_specialite: doctor ? doctor.specialite : 'Généraliste',
    patient_name: currentPatient.name,
    scheduled_at,
    status: 'confirmed',
    reason: reason || 'Consultation'
  };

  appointments.unshift(newAppointment);

  setFlash(
    req,
    'success',
    `Votre rendez-vous avec le Dr ${newAppointment.doctor_name} a été confirmé pour le ${new Date(
      scheduled_at
    ).toLocaleString('fr-FR')} !`
  );

  if (req.session.user && req.session.user.role === 'patient') {
    res.redirect('/patient/dashboard');
  } else {
    res.redirect('/rendez-vous/nouveau');
  }
});

app.delete('/rendezvous/:id', (req, res) => {
  const id = Number(req.params.id);
  const index = appointments.findIndex((a) => a.id === id);
  if (index !== -1) {
    appointments.splice(index, 1);
    setFlash(req, 'status', 'Le rendez-vous a été annulé avec succès.');
  }
  res.redirect('back');
});

// ----------------------------------------------------
// Patient Space
// ----------------------------------------------------

// Ensure demo user helper for easy exploration
function ensurePatient(req, res) {
  if (!req.session.user) {
    req.session.user = users.find((u) => u.role === 'patient');
  }
  res.locals.user = req.session.user;
}

app.get(['/patient', '/patient/dashboard'], (req, res) => {
  ensurePatient(req, res);
  const myAppointments = appointments.filter((a) => a.user_id === req.session.user.id);
  res.render('patient-dashboard', {
    title: 'Mon tableau de bord',
    user: req.session.user,
    appointments: myAppointments
  });
});

app.get('/patient/dossier', (req, res) => {
  ensurePatient(req, res);
  const myConsultations = consultations.filter((c) => c.patient_id === req.session.user.id);
  const myDocuments = documents.filter((d) => d.patient_id === req.session.user.id);

  res.render('patient-dossier', {
    title: 'Mon dossier médical',
    user: req.session.user,
    consultations: myConsultations,
    documents: myDocuments
  });
});

app.post('/patient/dossier/documents', (req, res) => {
  ensurePatient(req, res);
  const { title, type } = req.body;
  if (title) {
    documents.unshift({
      id: documents.length + 1,
      patient_id: req.session.user.id,
      title,
      type: type || 'Autre',
      size: '150 Ko',
      date: new Date().toISOString().slice(0, 10)
    });
    setFlash(req, 'success', `Le document "${title}" a été ajouté à votre dossier.`);
  }
  res.redirect('/patient/dossier');
});

app.get('/patient/profil', (req, res) => {
  ensurePatient(req, res);
  res.render('patient-profile', {
    title: 'Mon profil',
    user: req.session.user
  });
});

app.post('/patient/profil/update', (req, res) => {
  ensurePatient(req, res);
  const user = req.session.user;
  const { name, email, phone, dob, address, emergency_name, emergency_phone, insurance_company, insurance_number } = req.body;

  user.name = name || user.name;
  user.email = email || user.email;
  user.phone = phone || user.phone;
  user.dob = dob || user.dob;
  user.address = address || user.address;
  user.emergency_name = emergency_name || user.emergency_name;
  user.emergency_phone = emergency_phone || user.emergency_phone;
  user.insurance_company = insurance_company || user.insurance_company;
  user.insurance_number = insurance_number || user.insurance_number;

  // update master record
  const idx = users.findIndex((u) => u.id === user.id);
  if (idx !== -1) users[idx] = { ...users[idx], ...user };

  setFlash(req, 'success', 'Vos informations ont été mises à jour avec succès.');
  res.redirect('/patient/profil');
});

app.post('/patient/profil/password', (req, res) => {
  setFlash(req, 'success', 'Votre mot de passe a été modifié avec succès.');
  res.redirect('/patient/profil');
});

// ----------------------------------------------------
// Admin Space
// ----------------------------------------------------

function ensureAdmin(req, res) {
  if (!req.session.user || req.session.user.role !== 'admin') {
    req.session.user = users.find((u) => u.role === 'admin');
  }
  res.locals.user = req.session.user;
}

app.get(['/admin', '/admin/dashboard'], (req, res) => {
  ensureAdmin(req, res);
  const stats = {
    totalUsers: users.length,
    totalPatients: users.filter((u) => u.role === 'patient').length,
    totalDoctors: users.filter((u) => u.role === 'medecin').length,
    totalAppointments: appointments.length
  };
  const recentUsers = users.slice(-5).reverse();
  const recentAppointments = appointments.slice(0, 5);

  res.render('admin-dashboard', {
    title: 'Administration',
    user: req.session.user,
    stats,
    recentUsers,
    recentAppointments
  });
});

app.get('/admin/users', (req, res) => {
  ensureAdmin(req, res);
  res.render('admin-users', {
    title: 'Gestion des utilisateurs',
    user: req.session.user,
    users
  });
});

app.get('/admin/users/create', (req, res) => {
  ensureAdmin(req, res);
  res.render('admin-user-create', {
    title: 'Créer un utilisateur',
    user: req.session.user
  });
});

app.post('/admin/users', (req, res) => {
  ensureAdmin(req, res);
  const { name, email, role, password, specialite, centre_sante, ville } = req.body;
  const newUser = {
    id: users.length + 1,
    name,
    email,
    role,
    password: password || 'password',
    specialite,
    centre_sante,
    ville,
    created_at: new Date().toISOString().slice(0, 10)
  };
  users.push(newUser);
  setFlash(req, 'success', `L'utilisateur ${name} a été créé avec succès.`);
  res.redirect('/admin/users');
});

app.get('/admin/users/:id/edit', (req, res) => {
  ensureAdmin(req, res);
  const targetUser = users.find((u) => u.id == req.params.id);
  if (!targetUser) {
    setFlash(req, 'error', 'Utilisateur introuvable.');
    return res.redirect('/admin/users');
  }
  res.render('admin-user-edit', {
    title: 'Modifier un utilisateur',
    user: req.session.user,
    targetUser
  });
});

app.post('/admin/users/:id', (req, res) => {
  ensureAdmin(req, res);
  const targetUser = users.find((u) => u.id == req.params.id);
  if (targetUser) {
    const { name, email, role, phone, specialite, centre_sante, ville } = req.body;
    targetUser.name = name;
    targetUser.email = email;
    targetUser.role = role;
    targetUser.phone = phone;
    targetUser.specialite = specialite;
    targetUser.centre_sante = centre_sante;
    targetUser.ville = ville;
    setFlash(req, 'success', `Utilisateur #${targetUser.id} mis à jour.`);
  }
  res.redirect('/admin/users');
});

app.delete('/admin/users/:id', (req, res) => {
  ensureAdmin(req, res);
  const id = Number(req.params.id);
  const index = users.findIndex((u) => u.id === id);
  if (index !== -1) {
    users.splice(index, 1);
    setFlash(req, 'status', 'Utilisateur supprimé avec succès.');
  }
  res.redirect('/admin/users');
});

app.get('/admin/rendez-vous', (req, res) => {
  ensureAdmin(req, res);
  res.render('admin-rendezvous', {
    title: 'Tous les rendez-vous',
    user: req.session.user,
    appointments
  });
});

app.get('/admin/statistiques', (req, res) => {
  ensureAdmin(req, res);
  res.render('admin-statistiques', {
    title: 'Statistiques & Rapports',
    user: req.session.user
  });
});

// ----------------------------------------------------
// Medecin Space
// ----------------------------------------------------

function ensureMedecin(req, res) {
  if (!req.session.user || req.session.user.role !== 'medecin') {
    req.session.user = users.find((u) => u.role === 'medecin');
  }
  res.locals.user = req.session.user;
}

app.get(['/medecin', '/medecin/rendez-vous'], (req, res) => {
  ensureMedecin(req, res);
  const docAppointments = appointments.filter((a) => a.doctor_id === req.session.user.id);

  res.render('medecin-rendezvous', {
    title: 'Mes rendez-vous praticien',
    user: req.session.user,
    appointments: docAppointments
  });
});

app.get('/medecin/nouvelle-consultation', (req, res) => {
  ensureMedecin(req, res);
  const patientsList = users.filter((u) => u.role === 'patient');
  const selectedPatientId = req.query.patient_id || (patientsList[0] ? patientsList[0].id : null);

  res.render('medecin-consultation', {
    title: 'Nouvel acte médical',
    user: req.session.user,
    patients: patientsList,
    selectedPatientId
  });
});

app.post('/medecin/consultations', (req, res) => {
  ensureMedecin(req, res);
  const { patient_id, date_consultation, type_acte, motif, diagnostic, prescription } = req.body;
  const doc = req.session.user;

  consultations.unshift({
    id: consultations.length + 1,
    patient_id: Number(patient_id),
    doctor_id: doc.id,
    doctor_name: `Dr ${doc.name}`,
    doctor_specialite: doc.specialite || 'Médecin',
    date: date_consultation || new Date().toISOString().slice(0, 10),
    type: type_acte || 'Consultation générale',
    motif,
    diagnostic,
    prescription,
    created_at: new Date().toISOString().slice(0, 10)
  });

  setFlash(req, 'success', 'Nouvel acte médical enregistré avec succès dans le dossier du patient.');
  res.redirect('/medecin/rendez-vous');
});

// ----------------------------------------------------
// Start Server
// ----------------------------------------------------

app.listen(PORT, HOST, () => {
  console.log(`Médilink server running on http://${HOST}:${PORT}`);
});
