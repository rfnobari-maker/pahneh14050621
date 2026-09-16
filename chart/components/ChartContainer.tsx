
import React from 'react';

interface ChartContainerProps {
  title: string;
  children: React.ReactNode;
}

export const ChartContainer: React.FC<ChartContainerProps> = ({ title, children }) => {
  return (
    <div className="bg-slate-800/50 p-4 sm:p-6 rounded-xl border border-slate-700 shadow-lg backdrop-blur-sm transform hover:scale-[1.02] transition-transform duration-300 ease-out h-96 flex flex-col">
      <h2 className="text-lg font-semibold text-slate-100 mb-4">{title}</h2>
      <div className="flex-grow">
        {children}
      </div>
    </div>
  );
};
