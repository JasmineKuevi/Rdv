// In-memory data store with realistic seed data for Medilink

export const users = [
  {
    id: 1,
    name: "Dr. Admin Medilink",
    email: "admin@medilink.com",
    password: "password",
    role: "admin",
    created_at: "2025-01-10"
  },
  {
    id: 2,
    name: "Kossi Mensah",
    email: "mensah@medilink.com",
    password: "password",
    role: "medecin",
    specialite: "Cardiologie",
    centre_sante: "Clinique Espérance",
    ville: "Lomé",
    numero_ordre: "TG-MED-4421",
    created_at: "2025-01-15"
  },
  {
    id: 3,
    name: "Afi Amouzou",
    email: "amouzou@medilink.com",
    password: "password",
    role: "medecin",
    specialite: "Pédiatrie",
    centre_sante: "Centre Saint-Luc",
    ville: "Lomé",
    numero_ordre: "TG-MED-3910",
    created_at: "2025-01-18"
  },
  {
    id: 4,
    name: "Yao Adjovi",
    email: "adjovi@medilink.com",
    password: "password",
    role: "medecin",
    specialite: "Dermatologie",
    centre_sante: "Cabinet Horizon",
    ville: "Kara",
    numero_ordre: "TG-MED-5120",
    created_at: "2025-02-01"
  },
  {
    id: 5,
    name: "Mawuli Nayo",
    email: "nayo@medilink.com",
    password: "password",
    role: "medecin",
    specialite: "Ophtalmologie",
    centre_sante: "Polyclinique Centrale",
    ville: "Lomé",
    numero_ordre: "TG-MED-6288",
    created_at: "2025-02-10"
  },
  {
    id: 6,
    name: "Jean Kouassi",
    email: "patient@medilink.com",
    password: "password",
    role: "patient",
    phone: "+228 90 12 34 56",
    address: "Boulevard Circulaire, Lomé",
    dob: "1988-06-14",
    emergency_name: "Marie Kouassi (Épouse)",
    emergency_phone: "+228 91 65 43 21",
    insurance_company: "Santé Assurances Togo",
    insurance_number: "SAT-2025-8841",
    created_at: "2025-02-15"
  },
  {
    id: 7,
    name: "Aminata Diallo",
    email: "aminata@medilink.com",
    password: "password",
    role: "patient",
    phone: "+228 92 33 44 55",
    address: "Quartier Totsi, Lomé",
    dob: "1994-03-22",
    emergency_name: "Omar Diallo (Frère)",
    emergency_phone: "+228 90 77 88 99",
    insurance_company: "Gras Savoye Togo",
    insurance_number: "GS-40391",
    created_at: "2025-02-20"
  }
];

export const specialitesList = [
  { name: 'Cardiologie', desc: 'Soins du coeur et du système circulatoire.', image: 'cardio.png', slug: 'cardiologie' },
  { name: 'Dermatologie', desc: 'Soins de la peau, des cheveux et des ongles.', image: 'dermato.png', slug: 'dermatologie' },
  { name: 'Pédiatrie', desc: 'Suivi des enfants et nourrissons.', image: 'pediatrie.png', slug: 'pediatrie' },
  { name: 'Gynécologie', desc: 'Santé et bien-être des femmes.', image: 'gyneco.png', slug: 'gynecologie' },
  { name: 'Neurologie', desc: 'Troubles du cerveau et du système nerveux.', image: 'neuro.png', slug: 'neurologie' },
  { name: 'Dentisterie', desc: 'Soins et hygiène bucco-dentaire.', image: 'dentaire.png', slug: 'dentisterie' },
  { name: 'Ophtalmologie', desc: 'Santé des yeux et correction visuelle.', image: 'ophta.png', slug: 'ophtalmologie' },
  { name: 'Pneumologie', desc: 'Soins des poumons et de la respiration.', image: 'pneumo.png', slug: 'pneumologie' }
];

export const centresList = [
  { name: 'Clinique Espérance', ville: 'Lomé', services: 'Médecine générale, Cardiologie, Pédiatrie' },
  { name: 'Centre Saint-Luc', ville: 'Lomé', services: 'Pédiatrie, Gynécologie, Analyses' },
  { name: 'Polyclinique Centrale', ville: 'Kara', services: 'Ophtalmologie, Dermatologie, Urgences' },
  { name: 'Cabinet Horizon', ville: 'Kara', services: 'Dermatologie, Soins spécialisés' }
];

export const appointments = [
  {
    id: 1,
    user_id: 6,
    doctor_id: 2,
    doctor_name: "Kossi Mensah",
    doctor_specialite: "Cardiologie",
    patient_name: "Jean Kouassi",
    scheduled_at: "2026-09-15T10:00",
    status: "confirmed",
    reason: "Suivi cardiologique annuel et contrôle de la tension artérielle"
  },
  {
    id: 2,
    user_id: 6,
    doctor_id: 3,
    doctor_name: "Afi Amouzou",
    doctor_specialite: "Pédiatrie",
    patient_name: "Jean Kouassi",
    scheduled_at: "2026-09-22T14:30",
    status: "pending",
    reason: "Consultation pédiatrique pour fièvre persistante"
  },
  {
    id: 3,
    user_id: 7,
    doctor_id: 4,
    doctor_name: "Yao Adjovi",
    doctor_specialite: "Dermatologie",
    patient_name: "Aminata Diallo",
    scheduled_at: "2026-09-18T09:15",
    status: "confirmed",
    reason: "Examen dermatologique pour réaction allergique cutanée"
  },
  {
    id: 4,
    user_id: 6,
    doctor_id: 5,
    doctor_name: "Mawuli Nayo",
    doctor_specialite: "Ophtalmologie",
    patient_name: "Jean Kouassi",
    scheduled_at: "2026-08-10T11:00",
    status: "done",
    reason: "Contrôle de vision et renouvellement verres"
  }
];

export const cabinetRequests = [];

export const consultations = [
  {
    id: 1,
    patient_id: 6,
    doctor_id: 2,
    doctor_name: "Dr Kossi Mensah",
    doctor_specialite: "Cardiologie",
    date: "2026-08-10",
    type: "Consultation générale",
    motif: "Palpitations légères après effort",
    diagnostic: "Tension 12/7. ECG normal, rythme sinusal régulier. Pas de signe d'ischémie.",
    prescription: "Magnésium B6 1 cp matin et soir (30j). Règle hygiéno-diététique.",
    created_at: "2026-08-10"
  },
  {
    id: 2,
    patient_id: 6,
    doctor_id: 3,
    doctor_name: "Dr Afi Amouzou",
    doctor_specialite: "Pédiatrie",
    date: "2026-07-05",
    type: "Consultation générale",
    motif: "Fièvre et toux sèche",
    diagnostic: "Rhinopharyngite virale simple.",
    prescription: "Paracétamol 500mg (si fièvre > 38.5), Lavage nasal au sérum physiologique.",
    created_at: "2026-07-05"
  }
];

export const documents = [
  {
    id: 1,
    patient_id: 6,
    title: "Bilan_sanguin_complet.pdf",
    type: "Analyse",
    size: "220 Ko",
    date: "2026-08-10"
  },
  {
    id: 2,
    patient_id: 6,
    title: "Compte_rendu_ECG.pdf",
    type: "Imagerie",
    size: "185 Ko",
    date: "2026-08-10"
  },
  {
    id: 3,
    patient_id: 6,
    title: "Ordonnance_Magnesium.pdf",
    type: "Ordonnance",
    size: "95 Ko",
    date: "2026-08-10"
  }
];
