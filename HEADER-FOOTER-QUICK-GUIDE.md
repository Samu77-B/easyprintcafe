# ✅ Header & Footer - Quick Reference

## 🎯 Every Page Needs These 4 Things

---

## 1️⃣ CSS Links in `<head>`

### **For Pages in `/pages/` folder:**
```html
<head>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/footer.css">
</head>
```

### **For Files in Root (`/`):**
```html
<head>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./components/header.css">
    <link rel="stylesheet" href="./components/footer.css">
</head>
```

---

## 2️⃣ Header Placeholder (after `<body>`)

```html
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Your content here -->
```

---

## 3️⃣ Footer Placeholder (before `</body>`)

```html
    <!-- Your content -->
    
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Scripts next -->
</body>
```

---

## 4️⃣ Initialization Scripts (end of `<body>`)

### **For Pages in `/pages/` folder:**
```html
    <div id="footer-placeholder"></div>
    
    <script src="../js/header-init.js"></script>
    <script src="../js/footer-init.js"></script>
</body>
```

### **For Files in Root (`/`):**
```html
    <div id="footer-placeholder"></div>
    
    <script src="./js/header-init.js"></script>
    <script src="./js/footer-init.js"></script>
</body>
```

---

## 📋 Complete Template (Pages Folder)

Copy this for any page in `/pages/` folder:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title | Easy Print Cafe</title>
    
    <!-- Required CSS -->
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/footer.css">
</head>
<body>
    <!-- Header -->
    <div id="header-placeholder"></div>
    
    <!-- Your Content -->
    <main>
        <h1>Your Page Here</h1>
    </main>
    
    <!-- Footer -->
    <div id="footer-placeholder"></div>
    
    <!-- Initialize -->
    <script src="../js/header-init.js"></script>
    <script src="../js/footer-init.js"></script>
</body>
</html>
```

---

## ✅ Status of Your Pages

### **✓ Already Have Header/Footer:**
- ✅ `index.html`
- ✅ `product.php` (fixed)
- ✅ `pages/products.php` (fixed)
- ✅ `pages/about.html`
- ✅ `pages/contact.html`
- ✅ `pages/cafe-restaurant.html`
- ✅ `pages/student-academic.html`
- ✅ `pages/corporate-office.html`
- ✅ `pages/events-trade-shows.html`
- ✅ All other existing pages

### **All pages should now have working headers and footers!**

---

## 🔧 Quick Path Reference

| File Location | CSS Path | Script Path |
|--------------|----------|-------------|
| Root `/` | `./components/` | `./js/` |
| `/pages/` | `../components/` | `../js/` |
| `/pages/subdir/` | `../../components/` | `../../js/` |

---

## 🚨 Common Issues & Fixes

### **Issue:** Header/Footer not showing

**Fix:** Check script paths - should be `/js/` not `/components/`

```html
<!-- CORRECT -->
<script src="../js/header-init.js"></script>
<script src="../js/footer-init.js"></script>

<!-- WRONG -->
<script src="../components/header-init.js"></script>
```

### **Issue:** Styles look broken

**Fix:** Check CSS paths - should be `/components/` 

```html
<!-- CORRECT -->
<link rel="stylesheet" href="../components/header.css">

<!-- WRONG -->
<link rel="stylesheet" href="../js/header.css">
```

---

## 📝 Summary

**CSS Files:**  
- In `/components/` folder
- Include: header.css, footer.css, styles.css

**JavaScript Files:**  
- In `/js/` folder  
- Include: header-init.js, footer-init.js

**Every Page Needs:**
1. ✅ CSS links in `<head>`
2. ✅ `<div id="header-placeholder"></div>` after `<body>`
3. ✅ `<div id="footer-placeholder"></div>` before scripts
4. ✅ Script includes before `</body>`

---

**That's it! All your pages should now have consistent headers and footers.** ✅

