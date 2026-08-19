require('dotenv').config();
const { app, BrowserWindow, screen, Tray, Menu, globalShortcut, ipcMain } = require('electron');
const path = require('path');

const BASE_URL = process.env.BASE_URL || 'http://localhost/antrian_bri_console';

const WINDOWS_CONFIG = [
  {
    url: `${BASE_URL}/kios`,
    name: 'kios',
    monitorIndex: 0,
  },
  {
    url: `${BASE_URL}/`,
    name: 'console',
    monitorIndex: 1,
  },
];

let tray = null;

function createWindow({ url, name, monitorIndex }) {
  const displays = screen.getAllDisplays();
  const display = displays[monitorIndex] || displays[0] || screen.getPrimaryDisplay();

  const win = new BrowserWindow({
    x: display.bounds.x,
    y: display.bounds.y,
    width: display.bounds.width,
    height: display.bounds.height,
    autoHideMenuBar: true,
    frame: false,
    alwaysOnTop: true,
    title: 'Antrian BRI Console',
    webPreferences: {
      preload: path.join(__dirname, 'preload.js'),
      contextIsolation: true,
      nodeIntegration: false,
    },
  });

  win.loadURL(url);

  win.webContents.on('did-fail-load', (_e, code, desc) => {
    if (code === -3) return;
    console.error(`[${name}] failed to load (${code}): ${desc}`);
  });

  win.webContents.setWindowOpenHandler(() => ({ action: 'deny' }));

  return win;
}

function createTray() {
  const iconPath = path.join(__dirname, 'tray.ico');
  tray = new Tray(iconPath);
  tray.setToolTip('Antrian BRI Console');
  tray.setContextMenu(
    Menu.buildFromTemplate([
      { label: 'Quit', click: () => app.quit() },
    ]),
  );
  tray.on('double-click', () => tray.popUpContextMenu());
}

app.commandLine.appendSwitch('autoplay-policy', 'no-user-gesture-required');

app.whenReady().then(() => {
  WINDOWS_CONFIG.forEach((cfg) => createWindow(cfg));
  createTray();

  ipcMain.on('close-window', (_event) => {
    app.quit();
  });

  globalShortcut.register('CommandOrControl+Shift+Q', () => app.quit());

  app.on('activate', () => {
    if (BrowserWindow.getAllWindows().length === 0) WINDOWS_CONFIG.forEach(createWindow);
  });
});

app.on('window-all-closed', () => app.quit());

app.on('will-quit', () => {
  globalShortcut.unregisterAll();
});
