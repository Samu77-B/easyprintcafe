# 📄 Header & Footer Setup for All Pages

## ✅ Every Page Needs These 4 Things

---

## 1. CSS Links in `<head>` Section

```html
<head>
    <!-- ... other meta tags ... -->
    
    <!-- Required CSS -->
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/footer.css">
    
    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
```

**Note:** Adjust paths based on file location:
- **Root files** (`index.html`, `product.php`): Use `./components/`
- **Pages folder** (`pages/*.html`): Use `../components/`

---

## 2. Header Placeholder in `<body>`

Place immediately after opening `<body>` tag:

```html
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Your page content here -->
    
</body>
```

---

## 3. Footer Placeholder Before Closing `</body>`

Place just before scripts, at the end of body:

```html
    <!-- Your page content -->
    
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Scripts go here -->
</body>
```

---

## 4. Initialization Scripts

Place at the very end, just before closing `</body>` tag:

```html
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Initialize Header & Footer -->
    <script src="../components/header-init.js"></script>
    <script src="../components/footer-init.js"></script>
    
    <!-- Your custom page scripts can go here -->
    
</body>
</html>
```

**Note:** Adjust paths:
- **Root files**: `./components/header-init.js`
- **Pages folder**: `../components/header-init.js`

---

## 📋 Complete Page Template (for `/pages/` folder)

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title | Easy Print Cafe</title>
    <meta name="description" content="Page description">
    
    <!-- Required CSS -->
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Page-specific styles -->
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Main Content -->
    <main>
        <h1>Your Page Content</h1>
        <!-- Page content goes here -->
    </main>
    
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Initialize Components -->
    <script src="../components/header-init.js"></script>
    <script src="../components/footer-init.js"></script>
    
    <!-- Page-specific scripts -->
    <script>
        // Your custom JavaScript here
    </script>
</body>
</html>
```

---

## 📋 Complete Page Template (for Root folder)

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title | Easy Print Cafe</title>
    <meta name="description" content="Page description">
    
    <!-- Required CSS -->
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./components/header.css">
    <link rel="stylesheet" href="./components/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Page-specific styles -->
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Main Content -->
    <main>
        <h1>Your Page Content</h1>
        <!-- Page content goes here -->
    </main>
    
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Initialize Components -->
    <script src="./components/header-init.js"></script>
    <script src="./components/footer-init.js"></script>
    
    <!-- Page-specific scripts -->
    <script>
        // Your custom JavaScript here
    </script>
</body>
</html>
```

---

## 🔍 Path Reference Guide

### **Files in Root Directory** (`/`)
Example: `index.html`, `product.php`

```html
<!-- CSS -->
<link rel="stylesheet" href="./styles.css">
<link rel="stylesheet" href="./components/header.css">
<link rel="stylesheet" href="./components/footer.css">

<!-- Scripts -->
<script src="./components/header-init.js"></script>
<script src="./components/footer-init.js"></script>
```

### **Files in `/pages/` Directory**
Example: `pages/about.html`, `pages/products.php`

```html
<!-- CSS -->
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="../components/header.css">
<link rel="stylesheet" href="../components/footer.css">

<!-- Scripts -->
<script src="../components/header-init.js"></script>
<script src="../components/footer-init.js"></script>
```

### **Files in Subdirectories** (if you create any)
Example: `pages/products/category.html`

```html
<!-- CSS -->
<link rel="stylesheet" href="../../styles.css">
<link rel="stylesheet" href="../../components/header.css">
<link rel="stylesheet" href="../../components/footer.css">

<!-- Scripts -->
<script src="../../components/header-init.js"></script>
<script src="../../components/footer-init.js"></script>
```

---

## ✅ Verification Checklist

For each page, check:

- [ ] CSS links in `<head>` with correct paths
- [ ] `<div id="header-placeholder"></div>` after `<body>` tag
- [ ] `<div id="footer-placeholder"></div>` before scripts
- [ ] `header-init.js` script loaded
- [ ] `footer-init.js` script loaded
- [ ] Paths use `../` for pages folder or `./` for root

---

## 🔧 Quick Fix: Update an Existing Page

If a page is missing header/footer, add these:

### **1. In `<head>` section:**
```html
<link rel="stylesheet" href="../components/header.css">
<link rel="stylesheet" href="../components/footer.css">
```

### **2. After `<body>` tag:**
```html
<body>
    <div id="header-placeholder"></div>
```

### **3. Before `</body>` tag:**
```html
    <div id="footer-placeholder"></div>
    <script src="../components/header-init.js"></script>
    <script src="../components/footer-init.js"></script>
</body>
```

---

## 📝 Pages That Need Header & Footer

### **Essential Pages** (must have):
- ✅ `index.html` - Homepage
- ✅ `product.php` - Individual product page
- ✅ `pages/products.php` - Products listing
- ✅ `pages/about.html` - About page
- ✅ `pages/contact.html` - Contact page
- ✅ `pages/faq.html` - FAQ page
- ✅ `pages/terms-conditions.html` - Terms

### **Product Pages** (should have):
- `pages/printing-services.html`
- `pages/flags.html`
- `pages/feather-flag.html`
- `pages/teardrop-flag.html`
- `pages/crest-flag.html`
- `pages/fin-flag.html`
- `pages/flamingo-flag.html`

### **Solution Pages** (should have):
- `pages/cafe-restaurant.html`
- `pages/student-academic.html`
- `pages/corporate-office.html`
- `pages/events-trade-shows.html`
- `pages/student-print.html`

### **Design Pages** (should have):
- `pages/design-guidelines.html`
- `pages/design-feather-flag.html`
- `pages/design-teardrop-flag.html`
- `pages/design-crest-flag.html`
- `pages/design-fin-flag.html`
- `pages/design-flamingo-flag.html`

### **User Pages** (should have):
- `pages/dashboard.html`
- `pages/login.html`
- `pages/signup.html`
- `pages/file-upload.html`

### **Info Pages** (should have):
- `pages/delivery-info.html`
- `pages/cafe-affiliation.html`

---

## 🚨 Common Issues

### **Issue: Header/Footer Not Showing**

**Cause:** Path is incorrect

**Fix:** Check if file is in `/pages/` folder:
- Use `../components/` (NOT `./components/`)

---

### **Issue: Styles Look Wrong**

**Cause:** Missing CSS links

**Fix:** Add all three CSS files:
```html
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="../components/header.css">
<link rel="stylesheet" href="../components/footer.css">
```

---

### **Issue: Dropdown Menus Not Working**

**Cause:** Scripts not loaded

**Fix:** Add at end of body:
```html
<script src="../components/header-init.js"></script>
<script src="../components/footer-init.js"></script>
```

---

### **Issue: Console Shows 404 Errors**

**Cause:** Wrong path depth

**Fix:** 
- Root files: Use `./`
- Pages folder: Use `../`
- Check browser console (F12) for exact error

---

## 💡 Pro Tips

1. **Use a Template:** Copy a working page as your starting point
2. **Check Paths:** Most issues are wrong relative paths
3. **Test After Adding:** Open page in browser to verify
4. **Browser Console:** Press F12 to see errors
5. **Consistent Structure:** Keep all pages in same folder for easier path management

---

## 🎯 Quick Copy-Paste Snippets

### **For Pages in `/pages/` folder:**

**Add to `<head>`:**
```html
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="../components/header.css">
<link rel="stylesheet" href="../components/footer.css">
```

**Add after `<body>`:**
```html
<div id="header-placeholder"></div>
```

**Add before `</body>`:**
```html
<div id="footer-placeholder"></div>
<script src="../components/header-init.js"></script>
<script src="../components/footer-init.js"></script>
```

---

**That's it! Every page with these 4 elements will have a working header and footer.** ✅

---

**Created:** October 2025  
**For:** Easy Print Cafe Website  
**Status:** Reference Guide

