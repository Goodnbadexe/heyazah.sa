'use client';

import { createContext, useContext, useState, ReactNode } from 'react';

interface NavContextType {
  isOpen: boolean;
  setIsOpen: (isOpen: boolean) => void;
  toggleNav: () => void;
}

const NavContext = createContext<NavContextType>({
  isOpen: false,
  setIsOpen: () => {},
  toggleNav: () => {},
});

export function NavProvider({ children }: { children: ReactNode }) {
  const [isOpen, setIsOpen] = useState(false);

  const toggleNav = () => setIsOpen((prev) => !prev);

  return (
    <NavContext.Provider value={{ isOpen, setIsOpen, toggleNav }}>
      {children}
    </NavContext.Provider>
  );
}

export const useNav = () => useContext(NavContext);
