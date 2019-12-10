(function () {
    const w = window, C = '___grecaptcha_cfg', cfg = w[C] = w[C] || {}, N = 'grecaptcha';
    const gr = w[N] = w[N] || {};
    gr.ready = gr.ready || function (f) {
        (cfg['fns'] = cfg['fns'] || []).push(f);
    };
    (cfg['enterprise'] = cfg['enterprise'] || []).push(false);
    (cfg['render'] = cfg['render'] || []).push('onload');
    w['__google_recaptcha_client'] = true;
    const d = document, po = d.createElement('script');
    po.type = 'text/javascript';
    po.async = true;
    po.src = 'https://www.gstatic.com/recaptcha/releases/PRkVene3wKrZUWATSylf69ja/recaptcha__nl.js';
    const e = d.querySelector('script[nonce]'), n = e && (e['nonce'] || e.getAttribute('nonce'));
    if (n) {
        po.setAttribute('nonce', n);
    }
    const s = d.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
})();