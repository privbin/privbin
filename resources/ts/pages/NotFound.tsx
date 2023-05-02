import {AppLayout} from "@layouts";
import {Button} from "@components";

export function NotFound() {
  return (
    <AppLayout>
      <div className="flex-1 flex flex-col justify-center items-center py-32">
        <div className="space-y-4 text-center">
          <h1 className="text-4xl font-bold">404</h1>
          <p className="text-xl">Page not found</p>
          <Button onClick={() => window.location.href = '/'}>Go home</Button>
        </div>
      </div>
    </AppLayout>
  );
}
