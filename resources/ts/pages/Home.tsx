import {useState, Fragment} from "react";
import {Dialog, Transition} from '@headlessui/react';
import {Button, Editor, EditorSupportedLanguages, IEditorSupportedLanguages, Input, Select} from "@components";
import {AppLayout} from "@layouts";
import axios from "axios";
import toast from "react-hot-toast";
import {sleep} from "@helpers";

function SaveModal({ isOpen, onClose, language, code }: { isOpen: boolean, onClose: () => void, language: IEditorSupportedLanguages, code: string }) {
  const [title, setTitle] = useState<string>('');
  const [expires, setExpires] = useState<string>('forever');
  const [password, setPassword] = useState<string>('');
  const [isSaving, setIsSaving] = useState<boolean>(false);

  const save = async () => {
    setIsSaving(true);
    const savingToast = toast.loading('Saving...');

    try {
      const response = await axios.post('/api/pastes', {
        title,
        language,
        content: code,
        expires,
        password,
      });

      if (response.status === 200) {
        toast.success('Saved successfully!', { id: savingToast });
        await sleep(1000);
        window.location.href = `/pastes/${response.data.id}`;
      } else {
        toast.error(response.data.message, { id: savingToast });
      }
    } catch (e) {
      toast.error('An error occurred while saving the paste.', { id: savingToast });
    }

    setIsSaving(false);
  };

  return (
    <Transition appear show={isOpen} as={Fragment}>
      <Dialog as="div" className="relative z-10" onClose={onClose}>
        <Transition.Child
          as={Fragment}
          enter="ease-out duration-300"
          enterFrom="opacity-0"
          enterTo="opacity-100"
          leave="ease-in duration-200"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
        >
          <div className="fixed inset-0 bg-black bg-opacity-25" />
        </Transition.Child>

        <div className="fixed inset-0 overflow-y-auto">
          <div className="flex min-h-full items-center justify-center p-4 text-center">
            <Transition.Child
              as={Fragment}
              enter="ease-out duration-300"
              enterFrom="opacity-0 scale-95"
              enterTo="opacity-100 scale-100"
              leave="ease-in duration-200"
              leaveFrom="opacity-100 scale-100"
              leaveTo="opacity-0 scale-95"
            >
              <Dialog.Panel className="relative w-full max-w-xl transform overflow-hidden rounded-2xl bg-[#252526] text-white p-6 text-left align-middle shadow-xl transition-all">
                {isSaving && (
                  <div className="absolute top-0 left-0 right-0 bottom-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div className="w-24 h-24 border-4 border-transparent border-l-white border-t-white rounded-full animate-spin"></div>
                  </div>
                )}

                <Dialog.Title
                  as="h3"
                  className="text-lg font-medium leading-6 text-white"
                >
                  Save Your Paste
                </Dialog.Title>

                <div className="mt-6 space-y-4">
                  <Input
                    value={title}
                    onChange={setTitle}
                    className="border-[#4b4b4d]"
                    placeholder="Title"
                  />

                  <Select
                    value={expires}
                    onChange={setExpires}
                    options={[
                      {label: 'Store forever', value: 'forever'},
                      {label: 'Store for 1 day', value: '1day'},
                      {label: 'Store for 3 days', value: '3days'},
                      {label: 'Store for 1 week', value: '1week'},
                      {label: 'Store for 2 weeks', value: '2weeks'},
                      {label: 'Store for 1 month', value: '1month'},
                      {label: 'Store for 6 months', value: '6months'},
                      {label: 'Store for 1 year', value: '1year'},
                    ]}
                  />

                  <Input
                    value={password}
                    onChange={setPassword}
                    className="border-[#4b4b4d]"
                    placeholder="Password"
                    type="password"
                  />
                </div>

                <div className="mt-6">
                  <button
                    type="button"
                    className="w-full inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    onClick={save}
                  >
                    Save
                  </button>
                </div>
              </Dialog.Panel>
            </Transition.Child>
          </div>
        </div>
      </Dialog>
    </Transition>
  );
}

export function Home() {
  const [isSaveModalOpen, setIsSaveModalOpen] = useState(false);
  const [code, setCode] = useState('Hello World!');
  const [language, setLanguage] = useState<IEditorSupportedLanguages>(undefined);

  return (
    <AppLayout>
      <SaveModal
        isOpen={isSaveModalOpen}
        onClose={() => setIsSaveModalOpen(false)}
        language={language}
        code={code}
      />

      <div className="flex-1 flex flex-col space-y-4">
        <div className="flex space-x-4">
          <Select
            value={language}
            onChange={setLanguage}
            options={EditorSupportedLanguages.map((language) => ({label: language.name, value: language.value}))}
          />
          <div className="ml-auto">
            <Button onClick={() => setIsSaveModalOpen(true)}>
              Save
            </Button>
          </div>
        </div>

        <div className="flex-1 flex flex-col shadow-lg rounded-lg overflow-hidden">
          <Editor
            value={code}
            onChange={setCode}
            language={language ?? undefined}
            className="flex-1 h-full"
          />
        </div>
      </div>
    </AppLayout>
  );
}
