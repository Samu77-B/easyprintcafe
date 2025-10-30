# 🚀 Website Deployment Checklist - Easy Print Cafe

**Last Updated:** December 2024  
**Target Domain:** https://easyprintcafe.com  
**Hosting:** Hostinger  
**Current Status:** Ready for final deployment steps

---

## ✅ WHAT'S ALREADY COMPLETE

### **Website Components**
- ✅ Complete responsive website with 22+ pages
- ✅ Header/footer components standardized across all pages
- ✅ Product showcase system (Large Format & Small Format)
- ✅ AI-powered search functionality
- ✅ Modern, professional design
- ✅ Mobile-responsive layout

### **Database System**
- ✅ MySQL database configured (`u556329104_easyprintcafe`)
- ✅ Database credentials in `config/database.php`
- ✅ Product categories and products tables ready
- ✅ User authentication system
- ✅ Order management system
- ✅ File upload system

### **Files & Assets**
- ✅ All HTML pages complete
- ✅ CSS styling complete
- ✅ JavaScript functionality complete
- ✅ Product images in place
- ✅ Branding assets ready
- ✅ API endpoints ready

---

## 🎯 WHAT NEEDS TO BE DONE TO GO LIVE

### **1. Upload Files to Hostinger Server** ⏱️ 30-45 minutes

Upload all website files to your Hostinger server at `/public_html/build/`:

**Files to Upload:**
```
├── index.html (and all other .html files)
├── product.php
├── styles.css
├── .htaccess (NEW - just created)
├── components/ (header.html, footer.html, header.css, footer.css)
├── js/ (all JavaScript files)
├── api/ (all API endpoints)
├── config/ (database and config files)
├── pages/ (all page files)
├── images/ (all images)
├── brand/ (logos and branding)
├── video/ (video assets)
└── Products/ (product images)
```

**Upload Methods:**
- **Hostinger File Manager:** https://hpanel.hostinger.com/ → Websites → Manage → File Manager
- **FTP/SFTP:** Use FileZilla or similar with Hostinger credentials

---

### **2. Database Setup** ⏱️ 15-20 minutes

#### **A. Run Database Migration**
Visit: `https://easyprintcafe.com/build/config/products-migration.php`

You should see:
```
✓ Created product_categories table
✓ Created products table
✓ Created product_options table
✓ Created product_tags table
✓ Created product_tag_relations table
✓ Created product_related table
✅ All product tables created successfully!
```

#### **B. Insert Product Data**
1. **Large Format Products:**
   Visit: `https://easyprintcafe.com/build/config/insert-large-format-products.php`
   
2. **Small Format Products:**
   Visit: `https://easyprintcafe.com/build/config/insert-small-format-products.php`

#### **C. DELETE Migration Scripts** (Security)
After running successfully, **DELETE these files:**
- `config/products-migration.php`
- `config/insert-large-format-products.php`
- `config/insert-small-format-products.php`
- `config/insert-sample-products.php`

---

### **3. SSL Certificate** ⏱️ 5 minutes

Enable SSL in Hostinger Control Panel:
1. Go to: hPanel → Websites → Manage → SSL
2. Click "Install SSL Certificate" or "Enable SSL"
3. Select "Let's Encrypt" (free)
4. Test: `https://easyprintcafe.com`

---

### **4. Domain Configuration** ⏱️ 5 minutes

Verify your domain points to the correct directory:
- **Domain:** easyprintcafe.com → `/public_html/build/`

In Hostinger:
1. Websites → Manage → DNS Settings
2. Ensure A record points to your server IP
3. Check CNAME records if using subdomain

---

### **5. File Permissions** ⏱️ 5 minutes

Set correct file permissions (via FTP or SSH):

```bash
# Directories
chmod 755 public_html/build/
chmod 755 public_html/build/api/
chmod 755 public_html/build/config/
chmod 755 public_html/build/images/
chmod 755 public_html/build/js/

# Files
find public_html/build/ -type f -exec chmod 644 {} \;
find public_html/build/ -type d -exec chmod 755 {} \;
```

---

### **6. Test the Website** ⏱️ 15 minutes

Visit and test these URLs:

**Critical Pages:**
- [ ] https://easyprintcafe.com/build/
- [ ] https://easyprintcafe.com/build/pages/products.php
- [ ] https://easyprintcafe.com/build/product.php?slug=feather-flag
- [ ] https://easyprintcafe.com/build/pages/about.html
- [ ] https://easyprintcafe.com/build/pages/contact.html

**Test Functionality:**
- [ ] Header loads on all pages
- [ ] Footer loads on all pages
- [ ] Navigation menus work
- [ ] Products display correctly
- [ ] Search functionality works
- [ ] AI chat bot responds
- [ ] Mobile responsive design
- [ ] No 404 errors in console
- [ ] SSL certificate active (HTTPS)
- [ ] Images load correctly

---

## 🚨 CRITICAL SECURITY STEPS

### **1. Update Database Credentials**
If not already done, verify `config/database.php` has secure credentials:
- ✅ Current: `u556329104_easyprintcafe`
- Change password if needed

### **2. Update JWT Secret**
Verify JWT secret in `config/database.php`:
- ✅ Current secret is 64+ characters long
- Regenerate if needed: https://generate-secret.vercel.app/64

### **3. Remove .git Directory**
If you uploaded the entire project, remove `.git` folder from server:
```bash
rm -rf public_html/build/.git
```

### **4. Restrict Config Access**
The `.htaccess` file already includes protections for config files. Verify:
```apache
<FilesMatch "^(\.htaccess|\.git|\.gitignore|database\.php|security\.php|\.env)">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### **5. Check Error Logs**
Monitor error logs after deployment:
- **Location:** `/public_html/build/error_log`
- **Hostinger:** hPanel → Logs → Error Logs

---

## 📊 POST-DEPLOYMENT CHECKLIST

### **Performance**
- [ ] Website loads in < 3 seconds
- [ ] Images optimized (webp format)
- [ ] CSS/JS minified if needed
- [ ] Browser caching enabled (done via .htaccess)

### **SEO**
- [ ] Meta descriptions on all pages
- [ ] Title tags on all pages
- [ ] Alt text on all images
- [ ] Sitemap.xml created
- [ ] robots.txt created
- [ ] Google Analytics installed (if needed)
- [ ] Google Search Console verified

### **Analytics & Monitoring**
- [ ] Set up Google Analytics
- [ ] Set up Google Search Console
- [ ] Monitor error logs
- [ ] Set up uptime monitoring
- [ ] Set up backup schedule

---

## 🐛 TROUBLESHOOTING

### **Database Connection Errors**
1. Verify credentials in `config/database.php`
2. Check database exists in phpMyAdmin
3. Verify user has proper permissions
4. Check error logs for specific PDO errors

### **404 Errors**
1. Check `.htaccess` file uploaded correctly
2. Verify mod_rewrite enabled on server
3. Check file paths are correct
4. Verify files uploaded to correct directory

### **Images Not Loading**
1. Check file paths in HTML
2. Verify images uploaded to correct folders
3. Check file permissions (644)
4. Verify image URLs in database

### **SSL Not Working**
1. Enable SSL in Hostinger control panel
2. Wait 5-10 minutes for activation
3. Clear browser cache
4. Use SSL checker: https://www.ssllabs.com/ssltest/

### **PHP Errors**
1. Check PHP version (need 7.4+)
2. Check error logs
3. Verify PDO MySQL extension enabled
4. Check memory_limit in php.ini

---

## 📞 SUPPORT RESOURCES

**Hostinger Support:**
- Help Center: https://support.hostinger.com/
- Live Chat: Available in hPanel
- Documentation: https://support.hostinger.com/

**Project Documentation:**
- `README.md` - Project overview
- `SETUP-GUIDE.md` - Database setup
- `PRODUCT-DATABASE-SETUP.md` - Product system
- `HEADER-FOOTER-SETUP.md` - Component system

---

## 🎯 SUMMARY

### **Time Required:** 1-2 hours total
### **Difficulty:** Moderate
### **Status:** Ready to deploy

### **Quick Start:**
1. Upload all files to `/public_html/build/`
2. Run database migrations
3. Enable SSL certificate
4. Test all pages
5. Delete migration scripts
6. ✅ Website is live!

---

## 📝 NOTES

- **Backup First:** Always backup current server files before uploading
- **Test Locally:** Test database connections before going live
- **Gradual Rollout:** Consider testing with limited users first
- **Monitor:** Watch error logs for first 24-48 hours

---

**You're almost there! Just a few uploads and configuration steps away from going live!** 🚀

