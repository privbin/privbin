import './bootstrap';
import {createRoot} from 'react-dom/client';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import axios from "axios";
import toast from "react-hot-toast";
import {Home, NotFound, Show} from "@pages";

axios.interceptors.response.use((response) => response, (error) => {
  if (error.response.status === 401) {
    window.location.href = '/auth/login';
  } else if (error.response.status === 429) {
    toast.error('You have been rate limited. Please try again later.');
  }

  throw error;
});

const App = () => {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route index path="/" element={<Home/>}/>
          <Route path="/pastes/:id" element={<Show/>}/>
          <Route path="*" element={<NotFound/>}/>
        </Routes>
      </BrowserRouter>
    </>
  );
};

createRoot(document.getElementById('root')).render(<App/>);
