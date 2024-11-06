// resources/js/playwright-script.js
const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage();

  // Intercepta requests
  page.on('request', request => {
    if (request.url().includes('/rest/portal/resilientes')) {
      const headers = request.headers();
      if (headers['auth-token']) {
        console.log(headers['auth-token']); // Somente imprime o Auth-Token
      }
    }
  });

  await page.goto('https://s2id.mi.gov.br/#');
  await browser.close();
})();
