/**
 * Script to remove manual header/footer loading from all pages
 * This provides the exact text patterns to find and replace
 */

console.log('=== MANUAL LOADING CLEANUP ===');

const pagesToClean = [
    'pages/design-guidelines.html',
    'pages/design-fin-flag.html',
    'pages/design-crest-flag.html', 
    'pages/design-teardrop-flag.html',
    'pages/design-flamingo-flag.html',
    'pages/design-feather-flag.html',
    'pages/fin-flag.html',
    'pages/teardrop-flag.html',
    'pages/flamingo-flag.html',
    'pages/flags.html',
    'pages/crest-flag.html',
    'pages/feather-flag.html'
];

console.log('Pages that need manual loading code removed:');
pagesToClean.forEach((page, index) => {
    console.log(`${index + 1}. ${page}`);
});

console.log('\n=== REPLACEMENT PATTERNS ===');

console.log('\n1. HEADER LOADING - FIND:');
console.log(`fetch('../components/header.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('header-placeholder').innerHTML = data;
        
        // Fix logo paths and link for pages directory
        const logoDesktop = document.querySelector('.logo-desktop');
        const logoMobile = document.querySelector('.logo-mobile');
        const logoLink = document.querySelector('.logo-link');
        if (logoDesktop) logoDesktop.src = '../brand/epc - desktop.png';
        if (logoMobile) logoMobile.src = '../brand/epc - mobile.png';
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
    });`);

console.log('\nREPLACE WITH:');
console.log('// Header component is now loaded by centralized script');

console.log('\n2. FOOTER LOADING - FIND:');
console.log(`fetch('../components/footer.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('footer-placeholder').innerHTML = data;
    });`);

console.log('\nREPLACE WITH:');
console.log('// Footer component is now loaded by centralized script');

console.log('\n3. MOBILE MENU FUNCTIONS - FIND:');
console.log(`function initMobileMenu() {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    
    if (hamburgerMenu && mobileNav) {
        hamburgerMenu.addEventListener('click', function() {
            hamburgerMenu.classList.toggle('active');
            mobileNav.classList.toggle('active');
            
            if (mobileNav.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // Close menu when clicking on links
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburgerMenu.classList.remove('active');
                mobileNav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }
}`);

console.log('\nREPLACE WITH:');
console.log('// Mobile Menu Functionality is now handled by the centralized header script');

console.log('\n=== RESULT ===');
console.log('After cleanup, ALL pages will use the same header.html and footer.html components');
console.log('Changes to components will appear on ALL pages consistently');
