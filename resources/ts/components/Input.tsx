import classNames from "classnames";
import {Dispatch, SetStateAction} from "react";

interface InputProps {
  value: string;
  onChange: ((value: string) => void) | Dispatch<SetStateAction<string>>;
  className?: string;
  placeholder?: string;
  type?: 'text' | 'password';
}

export function Input({value, onChange, className, placeholder, type = "text"}: InputProps) {
  return (
    <input
      value={value}
      onChange={(e) => onChange(e.target.value)}
      placeholder={placeholder}
      className={classNames(
        'block w-full rounded-md border border-[#3e3e42] shadow-sm focus:border-[#007acc] focus:ring focus:ring-[#007acc] focus:ring-opacity-50 bg-[#252526] py-2 px-3 text-white',
        className
      )}
      type={type}
    />
  );
}
