# Header Component Usage Guide

## Problem Solved
The header component was inconsistent across pages because each page was manually handling:
- Logo path corrections
- Navigation link path corrections  
- Login status handling
- Mobile menu initialization
- Scroll animations

## Solution: Centralized Header Initialization

### For Root Directory Pages (index.html, etc.)
```html
<!-- Header Placeholder -->
<div id="header-placeholder"></div>

<!-- Centralized Header Initialization Script -->
<script src="js/header-init.js"></script>
```

### For Pages Directory (pages/*.html)
```html
<!-- Header Placeholder -->
<div id="header-placeholder"></div>

<!-- Centralized Header Initialization Script -->
<script src="../js/header-init.js"></script>
```

## What the Script Does Automatically

1. **Detects Current Location**: Automatically determines if the page is in the root directory or pages directory
2. **Fixes Logo Paths**: Sets correct paths for desktop and mobile logos
3. **Fixes Navigation Links**: Corrects all navigation and mobile navigation links
4. **Handles Login Status**: Shows/hides dashboard link and login/logout button based on localStorage
5. **Initializes Mobile Menu**: Sets up hamburger menu functionality
6. **Adds Scroll Animation**: Enables header scroll effects

## Migration Guide

### Before (Manual Implementation)
```html
<script>
    fetch('../components/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header-placeholder').innerHTML = data;
            
            // Fix logo link for pages directory
            const logoLink = document.querySelector('.logo-link');
            if (logoLink) logoLink.href = '../index.html';
            
            // Add scroll animation to header
            const header = document.querySelector('.header');
            if (header) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            }
            
            // Initialize mobile menu after header is loaded
            initMobileMenu();
        });
</script>
```

### After (Centralized Implementation)
```html
<script src="../js/header-init.js"></script>
```

## Benefits

- ✅ **Consistent**: All pages now have identical header behavior
- ✅ **Maintainable**: Changes to header logic only need to be made in one place
- ✅ **Automatic**: No manual path corrections needed
- ✅ **Robust**: Handles edge cases and different directory structures
- ✅ **Clean**: Removes duplicate code across all pages

## Files Updated

- ✅ `js/header-init.js` - New centralized script
- ✅ `index.html` - Updated to use centralized script
- ✅ `pages/about.html` - Updated to use centralized script  
- ✅ `pages/dashboard.html` - Updated to use centralized script

## Next Steps

To complete the migration, update all remaining pages to use the centralized script instead of their individual header initialization code.
