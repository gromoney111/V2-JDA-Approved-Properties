# V2 JDA Approved Properties

Custom WordPress theme + Google Sheets lead pipeline for **V2 JDA Approved Properties** — a Jaipur-based real estate firm specialising in JDA & RERA approved plots, villas and farm-house land (in association with the Shyamashish Group).

> **Contact:** Vishal Khandelwal · `+91 75979 61878` · `vishalkhandelwal267@gmail.com`
> **Social:** [Facebook](https://www.facebook.com/share/1Ct7vcFE6Y/) · [YouTube](https://youtube.com/@v2jdaapprovedproperties)

## What's in this repo

```
.
├── wp-theme/v2-jda-properties/   ← the WordPress theme (install this)
├── google-apps-script/Code.gs    ← receives leads into Google Sheets
└── docs/
    ├── INSTALL.md                ← step-by-step theme install
    ├── GOOGLE_SHEETS_SETUP.md    ← 5-minute Sheets setup
    └── CONTENT_GUIDE.md          ← how to add projects, photos, SEO copy
```

## Features

- **Home, About, Projects, Gallery, Media, Contact** — all six pages auto-created on theme activation.
- **Project custom post type** with `Ongoing / Completed / Upcoming` status taxonomy and per-project meta (price, area, address, RERA #, Google Maps embed, brochure link).
- **Animated, fully responsive UI** — hero zoom, animated counters, scroll-in fade/slide, project hover, lightbox gallery, sticky CTA, WhatsApp + Call floating buttons.
- **Lead capture pipeline** — every contact form submission is:
  1. Saved as a private `Lead` post in WordPress (with name, phone, email, interest, source URL).
  2. Forwarded to Google Sheets via the bundled Apps Script.
  3. Emailed to you.
- **SEO defaults** — meta description, keywords, Open Graph, Twitter card, `RealEstateAgent` JSON-LD. Plays nicely with Yoast / Rank Math when installed.
- **Theme Customizer** — change phone, email, social URLs, hero copy, lead webhook URL without touching code.
- **Original code, no licensing risk** — written from scratch, GPL-2.0-or-later.

## Quick start

1. **Install WordPress** on your hosting.
2. From `wp-theme/`, zip the `v2-jda-properties` folder and upload it via *Appearance → Themes → Add New → Upload Theme*. Activate.
3. Open *Appearance → Customize* and fill in the **V2 JDA - Contact**, **Social Links** and **Hero** sections.
4. Follow [`docs/GOOGLE_SHEETS_SETUP.md`](docs/GOOGLE_SHEETS_SETUP.md) (≈ 5 min) to wire up Google Sheets.
5. Add your projects under *Projects → Add New* (see [`docs/CONTENT_GUIDE.md`](docs/CONTENT_GUIDE.md)).

Full instructions: [`docs/INSTALL.md`](docs/INSTALL.md).

## Tech notes

- Pure PHP / vanilla JS / CSS — no build step required.
- WordPress 6.0+, PHP 7.4+.
- External assets (Google Fonts, Font Awesome) loaded from CDN; everything else is local.
- Animations are CSS + a small `IntersectionObserver` — no AOS.js dependency.

## Roadmap / nice-to-haves

These can be added later if you want them:

- reCAPTCHA v3 anti-spam on the lead form.
- A **Testimonials** custom post type so reviews can be added from the admin instead of theme files.
- A **Blog / News** archive for content marketing.
- Hindi translation (the theme is already i18n-ready via `__()` and `Text Domain: v2jda`).
- Real photos and project data — replace the Unsplash placeholders.

## License

GPL-2.0-or-later — same as WordPress core.
