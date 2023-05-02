import {defineConfig} from 'vite';
import laravel, {refreshPaths} from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tsconfigPaths from 'vite-tsconfig-paths';
import MonacoEditorPlugin from 'vite-plugin-monaco-editor';

export default defineConfig((env) => ({
  ... (env.command === 'build' ? {
    resolve: {
      alias: [
        { find: '@root', replacement: './resources/ts/' },
        { find: '@helpers', replacement: './resources/ts/helpers.ts' },
        { find: '@components', replacement: './resources/ts/components/index.ts' },
        { find: '@pages', replacement: './resources/ts/pages/index.ts' },
        { find: '@layouts', replacement: './resources/ts/layouts/index.ts' },
        { find: '@types', replacement: './resources/ts/index.d.ts' },
      ],
    },
  } : {
    // in dev mode, we use the tsconfig.json paths
  }),

  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/ts/app.tsx',
      ],
      refresh: [
        ...refreshPaths,
        'app/Http/Livewire/**',
      ],
    }),
    react({
      babel: {
        parserOpts: {
          plugins: ['decorators-legacy']
        }
      }
    }),
    tsconfigPaths(),
    MonacoEditorPlugin({
      languages: [
        'typescript',
        'javascript',
        'python',
        'cpp',
        'csharp',
        'css',
        'html',
        'json',
        'php',
      ]
    }),
  ],

  // build: {
  //   minify: false,
  //   sourcemap: true,
  // },
}));
