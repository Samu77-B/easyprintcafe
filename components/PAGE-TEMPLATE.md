# Page Template for Consistent Header/Footer Usage

## Standard Page Structure

All pages should follow this structure for consistent header and footer components:

### Root Directory Pages (index.html)
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title | Easy Print Cafe</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="components/header.css">
    <link rel="stylesheet" href="components/footer.css">
    <!-- Other head content -->
</head>
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Centralized Header Initialization Script -->
    <script src="js/header-init.js"></script>

    <main class="main">
        <!-- Page content -->
    </main>

    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Centralized Footer Initialization Script -->
    <script src="js/footer-init.js"></script>

    <!-- Page-specific scripts -->
    <script>
        // Page-specific functionality only
    </script>
</body>
</html>
```

### Pages Directory (pages/*.html)
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title | Easy Print Cafe</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/footer.css">
    <!-- Other head content -->
</head>
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Centralized Header Initialization Script -->
    <script src="../js/header-init.js"></script>

    <main class="main">
        <!-- Page content -->
    </main>

    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <!-- Centralized Footer Initialization Script -->
    <script src="../js/footer-init.js"></script>

    <!-- Page-specific scripts -->
    <script>
        // Page-specific functionality only
    </script>
</body>
</html>
```

## Migration Pattern

### What to Remove:
1. **Manual fetch() calls** for header.html and footer.html
2. **Path fixing code** for logos and navigation links
3. **Mobile menu initialization** functions
4. **Login status checking** code
5. **Header scroll animation** setup

### What to Add:
1. **Centralized header script**: `<script src="../js/header-init.js"></script>`
2. **Centralized footer script**: `<script src="../js/footer-init.js"></script>`

### What to Keep:
1. **Header placeholder**: `<div id="header-placeholder"></div>`
2. **Footer placeholder**: `<div id="footer-placeholder"></div>`
3. **Page-specific functionality** in separate script tags

## Benefits of This Approach

- ✅ **Consistent**: All pages have identical header/footer behavior
- ✅ **Maintainable**: Changes only need to be made in centralized scripts
- ✅ **Automatic**: Path corrections happen automatically
- ✅ **Clean**: No duplicate code across pages
- ✅ **Future-proof**: New pages just need the script tags

## Pages Still Needing Migration

The following pages still need to be updated to use the centralized components:

- pages/student-print.html
- pages/printing-services.html
- pages/cafe-affiliation.html
- pages/delivery-info.html
- pages/design-guidelines.html
- pages/terms-conditions.html
- pages/faq.html
- pages/design-fin-flag.html
- pages/design-crest-flag.html
- pages/design-teardrop-flag.html
- pages/design-flamingo-flag.html
- pages/design-feather-flag.html
- pages/fin-flag.html
- pages/teardrop-flag.html
- pages/flamingo-flag.html
- pages/flags.html
- pages/crest-flag.html
- pages/feather-flag.html
