
import React from 'react';
import type { DataSet } from '../types';

interface DataSelectorProps {
  dataSets: DataSet[];
  activeDataSetId: string;
  onDataSetChange: (id: string) => void;
}

export const DataSelector: React.FC<DataSelectorProps> = ({ dataSets, activeDataSetId, onDataSetChange }) => {
  return (
    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 bg-slate-800 rounded-lg border border-slate-700">
      <label htmlFor="dataset-select" className="block text-lg font-medium text-slate-300 mb-2 sm:mb-0 sm:ml-4">
        انتخاب مجموعه داده
      </label>
      <select
        id="dataset-select"
        value={activeDataSetId}
        onChange={(e) => onDataSetChange(e.target.value)}
        className="w-full sm:w-auto bg-slate-700 border border-slate-600 text-white text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block p-2.5 transition ease-in-out duration-150"
      >
        {dataSets.map((ds) => (
          <option key={ds.id} value={ds.id}>
            {ds.name}
          </option>
        ))}
      </select>
    </div>
  );
};