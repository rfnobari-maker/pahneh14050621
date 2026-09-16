import React from 'react';
// FIX: Import `Tooltip` to resolve 'Cannot find name' error.
import { Radar, RadarChart, PolarGrid, Legend, PolarAngleAxis, PolarRadiusAxis, ResponsiveContainer, Tooltip } from 'recharts';
import type { MonthlyData } from '../types';

interface RadarChartProps {
    data: MonthlyData[];
}

export const RadarChartComponent: React.FC<RadarChartProps> = ({ data }) => {
  return (
    <ResponsiveContainer width="100%" height="100%">
      <RadarChart cx="50%" cy="50%" outerRadius="80%" data={data}>
        <PolarGrid stroke="#475569" />
        <PolarAngleAxis dataKey="name" tick={{ fill: '#94a3b8' }} />
        <PolarRadiusAxis angle={30} domain={[0, 10000]} tick={{ fill: '#94a3b8' }} />
        <Tooltip
          contentStyle={{
            backgroundColor: '#1e293b',
            borderColor: '#475569',
            borderRadius: '0.5rem',
          }}
          labelStyle={{ color: '#f1f5f9' }}
        />
        <Legend wrapperStyle={{ color: '#cbd5e1' }} />
        <Radar name="درآمد" dataKey="revenue" stroke="#8884d8" fill="#8884d8" fillOpacity={0.6} />
        <Radar name="سود" dataKey="profit" stroke="#82ca9d" fill="#82ca9d" fillOpacity={0.6} />
      </RadarChart>
    </ResponsiveContainer>
  );
};