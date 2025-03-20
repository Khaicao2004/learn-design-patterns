import './bootstrap';

import React from 'react';
import { createInertiaApp } from '@inertiajs/inertia-react';
import { createRoot } from 'react-dom/client';

createInertiaApp({
    resolve: name => import(`./Pages/${name}`),
    setup({ el, App, props }) {
        const root = createRoot(el); // Tạo root mới
        root.render(<App {...props} />); // Render component vào root
    }
})  