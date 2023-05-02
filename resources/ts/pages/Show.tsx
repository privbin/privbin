import {useParams} from "react-router-dom";
import {AppLayout} from "@layouts";
import {Fragment, useEffect, useState} from "react";
import axios from "axios";
import {Editor, IEditorSupportedLanguages, Input} from "@components";
import {Dialog, Transition} from "@headlessui/react";

export function Show() {
  const {id} = useParams<{ id: string }>();
  const [loading, setLoading] = useState<boolean>(true);
  const [title, setTitle] = useState<string>('');
  const [language, setLanguage] = useState<IEditorSupportedLanguages>(undefined);
  const [content, setContent] = useState<string>('');
  const [isPasswordProtected, setIsPasswordProtected] = useState<boolean>(false);
  const [password, setPassword] = useState<string>('');

  const load = async () => {
    setLoading(true);
    try {
      const response = await axios.get(`/api/pastes/${id}`, {
        headers: {
          Authorization: `Bearer ${password}`,
        }
      });
      setTitle(response.data.title);
      setLanguage(response.data.language);
      setContent(response.data.content);
      setIsPasswordProtected(false);
    } catch (e) {
      if (e.response.status === 403) {
        setIsPasswordProtected(true);
      }

      console.error(e);
    }
    setLoading(false);
  };

  useEffect(() => {
    load();
  }, []);

  return (
    <AppLayout>
      <Transition appear show={isPasswordProtected} as={Fragment}>
        <Dialog as="div" className="relative z-10" onClose={() => null}>
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
                  {loading && (
                    <div className="absolute top-0 left-0 right-0 bottom-0 bg-black bg-opacity-50 flex items-center justify-center">
                      <div className="w-24 h-24 border-4 border-transparent border-l-white border-t-white rounded-full animate-spin"></div>
                    </div>
                  )}

                  <Dialog.Title
                    as="h3"
                    className="text-lg font-medium leading-6 text-white"
                  >
                    {loading ? 'Loading...' : 'Password required'}
                  </Dialog.Title>

                  <div className="mt-6 space-y-4">
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
                      onClick={load}
                    >
                      {loading ? 'Loading...' : 'Submit'}
                    </button>
                  </div>
                </Dialog.Panel>
              </Transition.Child>
            </div>
          </div>
        </Dialog>
      </Transition>

      {loading ? (
        <div className="flex items-center justify-center h-full py-32">
          <div className="animate-spin rounded-full h-24 w-24 border-4 border-transparent border-l-white border-t-white" />
        </div>
      ) : (
        <div className="flex-1 flex flex-col space-y-4">
          <div className="flex items-center justify-between">
            <h1 className="text-2xl font-bold">{title}</h1>
            <div>
              <span className="text-sm text-gray-500">{language}</span>
              <a
                href={`/pastes/${id}/raw`}
                target="_blank"
                className="text-sm text-gray-500"
              >
                RAW
              </a>
            </div>
          </div>
          <div className="flex-1 flex flex-col shadow-lg rounded-lg overflow-hidden">
            <Editor
              value={content}
              language={language}
              disabled
              className="flex-1 h-full"
            />
          </div>
        </div>
      )}
    </AppLayout>
  );
}
