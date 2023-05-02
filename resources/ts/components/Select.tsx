import classNames from "classnames";
import {Dispatch, SetStateAction} from "react";

interface SelectProps {
  value: string;
  onChange: ((value: string) => void) | Dispatch<SetStateAction<string>>;
  options: { label: string; value: string; }[];
  className?: string;
}

export function Select({value, onChange, options, className}: SelectProps) {
  return (
    <select
      value={value}
      onChange={(e) => onChange(e.target.value)}
      className={classNames(
        'block w-full rounded-md border-[#3e3e42] shadow-sm focus:border-[#007acc] focus:ring focus:ring-[#007acc] focus:ring-opacity-50 bg-[#252526]',
        className
      )}
    >
      {options.map((option, idX) => <option value={option.value} key={idX}>{option.label}</option>)}
    </select>
  );
}
