const esbuild = require('esbuild');
const fs      = require('fs');
const path    = require('path');

/* ================================================== */
/* ============ CONFIG =============================== */
/* ================================================== */

/* Fichiers JS à compiler */
const entryPoints = [
  'js/app.js',
  'js/splash.js',
  // 'js/slider.js',
];

/* Dossiers sources → destinations pour les assets */
const assetDirs = [
  {
    src:  path.resolve(__dirname, '../assets/imgs'),
    dest: path.resolve(__dirname, '../../dist/imgs'),
  },
  {
    src:  path.resolve(__dirname, '../assets/fonts'),
    dest: path.resolve(__dirname, '../../dist/fonts'),
  },
];

/* ================================================== */

const isWatch = process.argv.includes('--watch');
const outDir  = path.resolve(__dirname, '../../dist');

/* ---------- Helpers couleurs terminal ---------- */
const c = {
  reset:  '\x1b[0m',
  green:  '\x1b[32m',
  cyan:   '\x1b[36m',
  yellow: '\x1b[33m',
  grey:   '\x1b[90m',
};

/* ================================================== */
/* ============ COPIE DES ASSETS ==================== */
/* ================================================== */

/**
 * Copie récursivement src/ → dest/
 * Ne recopie que si le fichier source est plus récent (ou absent en dest)
 */
function copyAssets(src, dest) {
  if (!fs.existsSync(src)) {
    console.warn(`${c.yellow}[assets]${c.reset} Dossier source introuvable : ${src}`);
    return;
  }

  fs.mkdirSync(dest, { recursive: true });

  const entries = fs.readdirSync(src, { withFileTypes: true });
  let copied = 0;

  for (const entry of entries) {
    const srcPath  = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);

    if (entry.isDirectory()) {
      copyAssets(srcPath, destPath);
    } else {
      const srcMtime  = fs.statSync(srcPath).mtimeMs;
      const destMtime = fs.existsSync(destPath) ? fs.statSync(destPath).mtimeMs : 0;

      if (srcMtime > destMtime) {
        fs.copyFileSync(srcPath, destPath);
        copied++;
      }
    }
  }

  if (copied > 0) {
    console.log(`${c.green}[assets]${c.reset} ${copied} fichier(s) copié(s) → ${path.relative(process.cwd(), dest)}`);
  }
}

function buildAllAssets() {
  for (const { src, dest } of assetDirs) {
    copyAssets(src, dest);
  }
}

/* ================================================== */
/* ============ WATCH ASSETS (fs.watch) ============= */
/* ================================================== */

/**
 * Surveille un dossier et recopie à chaque modification
 */
function watchAssets(src, dest) {
  if (!fs.existsSync(src)) return;

  console.log(`${c.cyan}[assets]${c.reset} Watching ${path.relative(process.cwd(), src)}...`);

  fs.watch(src, { recursive: true }, (eventType, filename) => {
    if (!filename) return;

    const srcPath  = path.join(src, filename);
    const destPath = path.join(dest, filename);

    if (!fs.existsSync(srcPath)) {
      // Fichier supprimé → on supprime aussi en dist
      if (fs.existsSync(destPath)) {
        fs.rmSync(destPath, { force: true });
        console.log(`${c.yellow}[assets]${c.reset} Supprimé : dist/${filename}`);
      }
      return;
    }

    const stat = fs.statSync(srcPath);
    if (stat.isDirectory()) return;

    fs.mkdirSync(path.dirname(destPath), { recursive: true });
    fs.copyFileSync(srcPath, destPath);
    console.log(`${c.green}[assets]${c.reset} Copié : ${filename} → dist/${path.relative(src, destPath)}`);
  });
}

function watchAllAssets() {
  for (const { src, dest } of assetDirs) {
    watchAssets(src, dest);
  }
}

/* ================================================== */
/* ============ BUILD JS (esbuild) ================== */
/* ================================================== */

const buildOptions = {
  entryPoints: entryPoints.map(f => path.resolve(__dirname, '..', f)),
  outdir:      outDir,
  bundle:      false,
  minify:      true,
  sourcemap:   false,
  target:      ['es2017'],
  logLevel:    'info',
};

/* ================================================== */
/* ============ ENTRÉE PRINCIPALE =================== */
/* ================================================== */

(async () => {
  // Copie initiale des assets dans tous les cas
  buildAllAssets();

  if (isWatch) {
    // Watch JS via esbuild
    const ctx = await esbuild.context(buildOptions);
    await ctx.watch();
    console.log(`${c.cyan}[esbuild]${c.reset} Watching JS files...`);

    // Watch assets via fs.watch
    watchAllAssets();

    // Garder le process actif
    await new Promise(() => {});
  } else {
    await esbuild.build(buildOptions);
    console.log(`${c.green}[esbuild]${c.reset} JS build OK → ${path.relative(process.cwd(), outDir)}`);
  }
})();
