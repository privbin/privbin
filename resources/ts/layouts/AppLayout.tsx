import {ReactNode} from "react";

interface AppLayoutProps {
  children: ReactNode;
}

export function AppLayout({children}: AppLayoutProps) {
  return (
    <div className="bg-[#252526] text-white min-h-screen flex flex-col py-4">
      <div className="container mx-auto flex-1 flex flex-col">
        <div className="flex justify-between items-center py-4">
          <div className="flex items-center space-x-4">
            <a className="text-xl italic font-semibold" href="/">
              PrivBin
            </a>
          </div>
          <div className="flex items-center space-x-4">
            <div className="text-sm text-gray-500">
              <a href="https://github.com/sponsors/isaeken" target="_blank">
                Sponsor
              </a>
            </div>
          </div>
        </div>
        <div className="py-4 flex-1 flex flex-col">
          {children}
        </div>
        <div className="py-4">
          <div className="text-sm text-gray-500 text-center">
            <a href="/tos">
              Terms of Service
            </a>
            {' '}
            &middot;
            {' '}
            <a href="/privacy-policy">
              Privacy Policy
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
