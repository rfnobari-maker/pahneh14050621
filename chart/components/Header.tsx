
import React from 'react';

const ChartIcon: React.FC = () => (
    <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
        <path strokeLinecap="round" strokeLinejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
    </svg>
);


export const Header: React.FC = () => {
  return (
    <header className="mb-8 p-4 bg-slate-800/50 rounded-lg border border-slate-700 backdrop-blur-sm">
      <div className="flex items-center space-x-4">
        <ChartIcon />
        <div>
          <h1 className="text-2xl sm:text-3xl font-bold text-white tracking-tight">داشبورد نمودارهای پویا</h1>
          <p className="text-sm sm:text-base text-slate-400 mt-1">بصری‌سازی داده‌ها از بک‌اند PHP و MySQL</p>
        </div>
      </div>
    </header>
  );
};