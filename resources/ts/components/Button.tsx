import {ReactNode} from "react";
import classNames from "classnames";

interface ButtonProps {
  onClick: () => void;
  className?: string;
  children: ReactNode;
}

export function Button({onClick, className, children}: ButtonProps) {
  return (
    <button
      onClick={onClick}
      className={classNames(
        'px-4 py-2 rounded-md border-[#3e3e42] shadow-sm focus:border-[#007acc] focus:ring focus:ring-[#007acc] focus:ring-opacity-50 bg-[#323233] text-white font-semibold',
        className,
      )}
    >
      {children}
    </button>
  );
}
