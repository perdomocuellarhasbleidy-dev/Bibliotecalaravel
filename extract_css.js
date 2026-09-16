const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');
const cssDir = path.join(__dirname, 'resources', 'css');
const appCssPath = path.join(cssDir, 'app.css');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        const dirPath = path.join(dir, f);
        const isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

let appCssContent = fs.readFileSync(appCssPath, 'utf8');

walkDir(viewsDir, (filePath) => {
    if (!filePath.endsWith('.blade.php')) return;

    let content = fs.readFileSync(filePath, 'utf8');
    
    // Find all <style> blocks
    const styleRegex = /<style>([\s\S]*?)<\/style>/gi;
    let match;
    let modified = false;
    
    while ((match = styleRegex.exec(content)) !== null) {
        const cssContent = match[1].trim();
        if (cssContent.length === 0) continue;

        // Generate a name based on the file path
        let relativePath = path.relative(viewsDir, filePath);
        let baseName = relativePath.replace(/\\/g, '-').replace(/\//g, '-').replace('.blade.php', '');
        let newCssFile = `${baseName}.css`;
        
        // Write the CSS file
        fs.writeFileSync(path.join(cssDir, newCssFile), cssContent);
        
        // Add to app.css if not there
        const importStatement = `@import './${newCssFile}';`;
        if (!appCssContent.includes(importStatement)) {
            appCssContent += `\n${importStatement}`;
        }

        // Check if the file is a full HTML page (has <head>)
        if (content.includes('</head>')) {
            // Check if it already has @vite
            if (!content.includes('@vite')) {
                content = content.replace(match[0], `@vite(['resources/css/app.css', 'resources/js/app.js'])`);
            } else {
                content = content.replace(match[0], ''); // just remove it
            }
        } else {
            // Partial view, just remove the <style> block
            content = content.replace(match[0], '');
        }
        
        modified = true;
    }

    if (modified) {
        fs.writeFileSync(filePath, content);
        console.log(`Extracted CSS from ${filePath}`);
    }
});

fs.writeFileSync(appCssPath, appCssContent);
console.log('Updated app.css');
