import {Editor as MonacoEditor} from '@monaco-editor/react';

export const SupportedLanguages = [
  { name: 'TypeScript', value: 'typescript' },
  { name: 'JavaScript', value: 'javascript' },
  { name: 'Python', value: 'python' },
  { name: 'C++', value: 'cpp' },
  { name: 'C#', value: 'csharp' },
  { name: 'CSS', value: 'css' },
  { name: 'HTML', value: 'html' },
  { name: 'JSON', value: 'json' },
  { name: 'PHP', value: 'php' },
  { name: 'Plain Text', value: undefined },
] as const;

export type ISupportedLanguages =
  'typescript' |
  'javascript' |
  'python' |
  'cpp' |
  'csharp' |
  'css' |
  'html' |
  'json' |
  'php' |
  undefined;

interface EditorProps {
  value: string;
  onChange?: (value: string) => void;
  language?: ISupportedLanguages | undefined;
  className?: string;
  disabled?: boolean;
}

export function Editor({value, onChange, language, className, disabled}: EditorProps) {
  return (
    <MonacoEditor
      defaultValue={value}
      onChange={onChange}
      language={language}
      className={className}
      onMount={(editor) => {
        const resize = () => {
          const width = (editor.getContainerDomNode()?.parentElement?.parentElement?.offsetWidth);
          const height = (editor.getContainerDomNode()?.parentElement?.parentElement?.offsetHeight);

          if (width && height) {
            editor.layout({
              width,
              height,
            });
          }
        };

        resize();
        window.addEventListener('resize', resize);
        window.addEventListener('focus', resize);

        editor.updateOptions({
          readOnly: disabled,
        });
      }}
      theme="vs-dark"
    />
  );
}
