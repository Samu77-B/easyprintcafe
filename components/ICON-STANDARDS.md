# Icon Standards for Easy Print Cafe

## Icon System
All pages use **Font Awesome 6.4.0** icons for consistency.

## Required CDN Link
Add this to the `<head>` of every page:
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

## Common Icons Used Across Site

### Product Features
- **Wind-resistant**: `<i class="fas fa-wind"></i>`
- **Full-color printing**: `<i class="fas fa-palette"></i>`
- **Quick setup**: `<i class="fas fa-bolt"></i>`
- **High quality**: `<i class="fas fa-award"></i>`
- **Fast turnaround**: `<i class="fas fa-clock"></i>`
- **Weather resistant**: `<i class="fas fa-shield-alt"></i>`
- **Professional**: `<i class="fas fa-star"></i>`
- **Eye-catching**: `<i class="fas fa-eye"></i>`
- **Traditional/Heritage**: `<i class="fas fa-crown"></i>` or `<i class="fas fa-scroll"></i>`

### Dashboard & Actions
- **User/Profile**: `<i class="fas fa-user"></i>`
- **Shopping cart**: `<i class="fas fa-shopping-cart"></i>`
- **Files**: `<i class="fas fa-file-alt"></i>`
- **Upload**: `<i class="fas fa-cloud-upload-alt"></i>`
- **Download**: `<i class="fas fa-download"></i>`
- **Settings**: `<i class="fas fa-cog"></i>`
- **Support/Help**: `<i class="fas fa-headset"></i>`
- **Chart/Stats**: `<i class="fas fa-chart-bar"></i>`

### Services
- **Cafe/Restaurant**: `<i class="fas fa-coffee"></i>`
- **Student/Academic**: `<i class="fas fa-graduation-cap"></i>`
- **Corporate/Office**: `<i class="fas fa-building"></i>`
- **Events/Trade Shows**: `<i class="fas fa-users"></i>`

## CSS Styling

### Standard Feature Icon Styles
```css
.feature-icon {
    font-size: 1.5rem;
    color: #597525; /* Brand green */
}

/* For white backgrounds */
.hero-features .feature-icon {
    font-size: 3rem;
    color: white;
}
```

### Service Card Icons
```css
.service-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #8eb442, #7a9c3a);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}
```

## Pages Updated
✅ `pages/flags.html`
✅ `pages/feather-flag.html`
✅ `pages/crest-flag.html`
✅ `pages/teardrop-flag.html`
✅ `pages/flamingo-flag.html`
✅ `pages/fin-flag.html`
✅ `pages/printing-services.html`
✅ `pages/dashboard.html`
✅ `pages/cafe-restaurant.html`
✅ `pages/student-academic.html`
✅ `pages/corporate-office.html`
✅ `pages/events-trade-shows.html`

## DO NOT Use
- ❌ Emoji icons (🌪️, 🎨, etc.)
- ❌ PNG image icons (except for logo and product images)
- ❌ Mixed icon styles

## For New Pages
1. Add Font Awesome CDN link in `<head>`
2. Choose appropriate icons from the list above
3. Use consistent CSS classes: `.feature-icon`, `.service-icon`, etc.
4. Follow the color scheme: `#597525` (brand green) or white on colored backgrounds

