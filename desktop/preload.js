const { contextBridge, ipcRenderer } = require('electron');

contextBridge.exposeInMainWorld('electron', {
  platform: process.platform,
  close: () => ipcRenderer.send('close-window'),
});

// Inject top bar into the page
window.addEventListener('DOMContentLoaded', () => {
  const bar = document.createElement('div');
  bar.id = 'electron-topbar';
  bar.innerHTML = `
    <span>Antrian BRI Console</span>
    <button id="electron-close-btn" title="Close">&times;</button>
  `;
  document.body.prepend(bar);

  const style = document.createElement('style');
  style.textContent = `
    #electron-topbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 32px;
      background: rgba(0, 0, 0, 0.85);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 8px;
      z-index: 2147483647;
      -webkit-app-region: drag;
      user-select: none;
    }
    #electron-topbar span {
      font-size: 13px;
      font-family: Segoe UI, sans-serif;
      opacity: 0.8;
    }
    #electron-close-btn {
      -webkit-app-region: no-drag;
      background: none;
      border: none;
      color: #fff;
      font-size: 18px;
      width: 32px;
      height: 32px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
    }
    #electron-close-btn:hover {
      background: #e81123;
    }
  `;
  document.head.appendChild(style);

  document.getElementById('electron-close-btn').addEventListener('click', () => {
    window.electron.close();
  });
});
