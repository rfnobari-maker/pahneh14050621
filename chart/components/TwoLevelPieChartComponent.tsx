import React from 'react';
// FIX: Import `Tooltip` to resolve 'Cannot find name' error.
import { PieChart, Pie, Cell, ResponsiveContainer, Legend, Tooltip } from 'recharts';
import { twoLevelPieInnerData, twoLevelPieOuterData } from '../data/sampleData';

const COLORS_INNER = ['#0088FE', '#00C49F', '#FFBB28', '#FF8042'];
const COLORS_OUTER = ['#AF19FF', '#FF4560', '#775DD0', '#00E396', '#FEB019', '#FF66C3', '#546E7A'];

export const TwoLevelPieChartComponent: React.FC = () => {
  return (
    <ResponsiveContainer width="100%" height="100%">
      <PieChart>
        <Pie
          // FIX: Cast data to `any` to resolve a typing conflict with recharts' expected data type.
          data={twoLevelPieInnerData as any}
          dataKey="value"
          cx="50%"
          cy="50%"
          outerRadius={60}
          fill="#8884d8"
        >
          {twoLevelPieInnerData.map((entry, index) => (
            <Cell key={`cell-inner-${index}`} fill={COLORS_INNER[index % COLORS_INNER.length]} />
          ))}
        </Pie>
        <Pie
          // FIX: Cast data to `any` to resolve a typing conflict with recharts' expected data type.
          data={twoLevelPieOuterData as any}
          dataKey="value"
          cx="50%"
          cy="50%"
          innerRadius={70}
          outerRadius={90}
          fill="#82ca9d"
          labelLine={false}
          // FIX: Explicitly type props as `any` to prevent type inference errors during arithmetic operations.
          label={({ cx, cy, midAngle, innerRadius, outerRadius, percent }: any) => {
              const RADIAN = Math.PI / 180;
              const radius = innerRadius + (outerRadius - innerRadius) * 0.5;
              const x = cx + radius * Math.cos(-midAngle * RADIAN);
              const y = cy + radius * Math.sin(-midAngle * RADIAN);

              if (percent < 0.05) return null; // Don't render label if slice is too small

              return (
                <text x={x} y={y} fill="white" textAnchor={x > cx ? 'start' : 'end'} dominantBaseline="central" fontSize="12">
                  {`${(percent * 100).toFixed(0)}%`}
                </text>
              );
            }}
        >
        {twoLevelPieOuterData.map((entry, index) => (
            <Cell key={`cell-outer-${index}`} fill={COLORS_OUTER[index % COLORS_OUTER.length]} />
          ))}
        </Pie>
        <Tooltip
          contentStyle={{
            backgroundColor: '#1e293b',
            borderColor: '#475569',
            borderRadius: '0.5rem',
          }}
          labelStyle={{ color: '#f1f5f9' }}
        />
        <Legend wrapperStyle={{ color: '#cbd5e1' }} />
      </PieChart>
    </ResponsiveContainer>
  );
};