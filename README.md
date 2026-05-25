<div align="center">

# ⚖️ UDebate

**Piattaforma di dibattito**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js&logoColor=white)](https://alpinejs.dev)

![UDebate Banner](banner.png)

</div>

---

## 📖 Cos'è UDebate

UDebate è una piattaforma web per il dibattito universitario. Gli utenti possono aprire tesi, rispondere a quelle degli altri, esprimere like e monitorare la propria attività tramite una dashboard personale in tempo reale.

---

## ✨ Funzionalità

| Feature | Descrizione |
|---|---|
| 🔐 **Autenticazione** | Registrazione, login e verifica email |
| 💬 **Dibattiti** | Apertura, modifica ed eliminazione tesi |
| ❤️ **Like** | Toggle like/unlike senza ricaricare la pagina (AJAX) |
| ↩️ **Commenti** | Risposte in tempo reale via AJAX |
| 📊 **Dashboard** | Statistiche personali: dibattiti aperti, like ricevuti, risposte |
| 🔥 **Trending** | Lista dei topic più discussi in sidebar |
| ⚡ **Sfida del giorno** | Quesito quotidiano con votazione Sì/No |

---

## 🛠️ Stack tecnologico

- **Backend** — Laravel 13, PHP 8.3
- **Frontend** — Blade, Tailwind CSS, Alpine.js
- **Database** — MySQL
- **Build tool** — Vite
- **Containerizzazione** — Docker & Docker Compose

---

## 🚀 Installazione

### Con Docker (consigliato)

```bash
# 1. Clona il repository
git clone https://github.com/FrancescoScanni/UDebate.git
cd UDebate

# 2. Copia la configurazione
cp .env.example .env

# 3. Avvia i container
docker compose up -d

# 4. Installa le dipendenze PHP
docker exec -it <container_name> composer install

# 5. Genera la chiave applicativa
docker exec -it <container_name> php artisan key:generate

# 6. Esegui le migrazioni
docker exec -it <container_name> php artisan migrate

# 7. Compila gli asset
npm install && npm run build
```

> L'app sarà disponibile su **http://localhost:8080**

---

### Installazione locale

```bash
git clone https://github.com/FrancescoScanni/UDebate.git
cd UDebate

composer install
cp .env.example .env
php artisan key:generate

# Configura il database nel file .env, poi:
php artisan migrate

npm install && npm run build
php artisan serve
```

---

## ⚙️ Configurazione `.env`

```env
APP_NAME=UDebate
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app (default di livewire)
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📁 Struttura del progetto

```
UDebate/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DebateController.php    # Dashboard + CRUD dibattiti
│   │       ├── LikeController.php      # Toggle like (AJAX)
│   │       └── CommentController.php   # Invio commenti (AJAX)
│   └── Models/
│       ├── Debate.php
│       ├── Like.php
│       └── Comment.php
├── resources/
│   └── views/
│       └── dashboard.blade.php         # Vista principale
├── routes/
│   └── web.php
├── database/
│   └── migrations/
├── docker-compose.yml
└── README.md
```

---

## 🔌 API Routes principali

| Metodo | Route | Descrizione |
|---|---|---|
| `GET` | `/dashboard` | Dashboard principale |
| `POST` | `/debates` | Crea nuovo dibattito |
| `PATCH` | `/debates/{id}` | Modifica dibattito |
| `DELETE` | `/debates/{id}` | Elimina dibattito |
| `POST` | `/debates/{id}/like` | Toggle like |
| `POST` | `/debates/{id}/comments` | Aggiungi commento |

---

## 👤 Autori

**Francesco Scanni**

[![GitHub](https://img.shields.io/badge/GitHub-FrancescoScanni-181717?style=flat-square&logo=github)](https://github.com/FrancescoScanni)

**Alessandro Lorusso (IL GOAT)**

[![GitHub](https://img.shields.io/badge/GitHub-flexmyedit-181717?style=flat-square&logo=github)](https://github.com/flexmyedit)

**Andrea Massari**

[![GitHub](https://img.shields.io/badge/GitHub-MassariAndrea-181717?style=flat-square&logo=github)](https://github.com/MassariAndrea)

**Gabriele Galeazzi**

[![GitHub](https://img.shields.io/badge/GitHub-Gale4zz1-181717?style=flat-square&logo=github)](https://github.com/Gale4zz1)

---

<div align="center">
  <sub>Fatto con ❤️ metta 10 a lorusso please </sub>
</div>
