/**
 * Verification Script: Check Header/Footer on All Pages
 * This shows which pages have proper header/footer setup
 */

const fs = require('fs');
const path = require('path');

// Pages to check
const pagesToCheck = [
    'index.html',
    'product.php',
    'pages/products.php',
    'pages/about.html',
    'pages/contact.html',
    'pages/cafe-restaurant.html',
    'pages/student-academic.html',
    'pages/corporate-office.html',
    'pages/events-trade-shows.html',
    'pages/student-print.html',
    'pages/faq.html',
    'pages/terms-conditions.html',
    'pages/delivery-info.html',
    'pages/design-guidelines.html',
    'pages/printing-services.html',
    'pages/dashboard.html',
    'pages/login.html',
    'pages/signup.html',
    'pages/file-upload.html',
    'pages/cafe-affiliation.html',
    'pages/flags.html',
    'pages/feather-flag.html',
    'pages/teardrop-flag.html',
    'pages/crest-flag.html',
    'pages/fin-flag.html',
    'pages/flamingo-flag.html',
    'pages/design-feather-flag.html',
    'pages/design-teardrop-flag.html',
    'pages/design-crest-flag.html',
    'pages/design-fin-flag.html',
    'pages/design-flamingo-flag.html'
];

console.log('═══════════════════════════════════════════════════');
console.log('  HEADER & FOOTER VERIFICATION');
console.log('═══════════════════════════════════════════════════\n');

let totalPages = 0;
let pagesWithHeader = 0;
let pagesWithFooter = 0;
let pagesWithBoth = 0;
let missingPages = [];
let issuePages = [];

pagesToCheck.forEach(pagePath => {
    try {
        const content = fs.readFileSync(pagePath, 'utf8');
        totalPages++;
        
        const hasHeaderPlaceholder = content.includes('id="header-placeholder"');
        const hasFooterPlaceholder = content.includes('id="footer-placeholder"');
        const hasHeaderInit = content.includes('header-init.js');
        const hasFooterInit = content.includes('footer-init.js');
        
        if (hasHeaderPlaceholder) pagesWithHeader++;
        if (hasFooterPlaceholder) pagesWithFooter++;
        if (hasHeaderPlaceholder && hasFooterPlaceholder && hasHeaderInit && hasFooterInit) {
            pagesWithBoth++;
            console.log(`✅ ${pagePath}`);
        } else {
            let issues = [];
            if (!hasHeaderPlaceholder) issues.push('Missing header placeholder');
            if (!hasFooterPlaceholder) issues.push('Missing footer placeholder');
            if (!hasHeaderInit) issues.push('Missing header-init.js');
            if (!hasFooterInit) issues.push('Missing footer-init.js');
            
            console.log(`⚠️  ${pagePath}`);
            console.log(`   Issues: ${issues.join(', ')}\n`);
            
            issuePages.push({
                path: pagePath,
                issues: issues
            });
        }
    } catch (error) {
        console.log(`❌ ${pagePath} - File not found`);
        missingPages.push(pagePath);
    }
});

console.log('\n═══════════════════════════════════════════════════');
console.log('  SUMMARY');
console.log('═══════════════════════════════════════════════════');
console.log(`Total pages checked: ${totalPages}`);
console.log(`Pages with complete setup: ${pagesWithBoth}`);
console.log(`Pages with issues: ${issuePages.length}`);
console.log(`Files not found: ${missingPages.length}`);

if (issuePages.length > 0) {
    console.log('\n⚠️  PAGES NEEDING FIXES:');
    issuePages.forEach(page => {
        console.log(`   ${page.path}`);
        page.issues.forEach(issue => {
            console.log(`      - ${issue}`);
        });
    });
}

console.log('\n═══════════════════════════════════════════════════\n');

