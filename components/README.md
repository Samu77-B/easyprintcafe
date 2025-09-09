# Header Component Usage

## How to use the header component on any page:

1. **Include the CSS file** in your HTML head:
```html
<link rel="stylesheet" href="components/header.css">
```

2. **Add the header placeholder** in your HTML body:
```html
<div id="header-placeholder"></div>
```

3. **Add the JavaScript** to load the component:
```html
<script>
    // Load header component
    fetch('components/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header-placeholder').innerHTML = data;
        });
</script>
```

## Example complete page structure:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="components/header.css">
    <link rel="stylesheet" href="your-page-styles.css">
</head>
<body>
    <div id="header-placeholder"></div>
    
    <script>
        fetch('components/header.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-placeholder').innerHTML = data;
            });
    </script>
    
    <!-- Your page content here -->
    <main>
        <!-- Page content -->
    </main>
</body>
</html>
```

## Notes:
- The header component includes responsive design
- Logo automatically switches between desktop and mobile versions
- All navigation links are included and styled
- The component is fully self-contained with its own CSS
