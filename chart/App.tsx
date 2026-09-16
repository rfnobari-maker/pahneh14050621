
import React, { useState } from 'react';
import { Header } from './components/Header';
import { DataSelector } from './components/DataSelector';
import { ChartContainer } from './components/ChartContainer';
import { BarChartComponent } from './components/BarChartComponent';
import { LineChartComponent } from './components/LineChartComponent';
import { AreaChartComponent } from './components/AreaChartComponent';
import { PieChartComponent } from './components/PieChartComponent';
import { RadarChartComponent } from './components/RadarChartComponent';
import { TwoLevelPieChartComponent } from './components/TwoLevelPieChartComponent';
import { salesData, userActivityData, inventoryData, marketingData } from './data/sampleData';
import type { DataSet } from './types';

const dataSets: DataSet[] = [
  { id: 'sales', name: 'داده‌های فروش (ماهانه)', data: salesData, pieData: inventoryData },
  { id: 'activity', name: 'فعالیت کاربران (روزانه)', data: userActivityData, pieData: marketingData },
];

const App: React.FC = () => {
  const [activeDataSetId, setActiveDataSetId] = useState<string>(dataSets[0].id);

  const activeDataSet = dataSets.find(ds => ds.id === activeDataSetId) ?? dataSets[0];

  return (
    <div className="min-h-screen bg-slate-900 font-sans p-4 sm:p-6 lg:p-8">
      <div className="max-w-7xl mx-auto">
        <Header />
        <main>
          <DataSelector
            dataSets={dataSets}
            activeDataSetId={activeDataSetId}
            onDataSetChange={setActiveDataSetId}
          />
          <div className="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">
            <ChartContainer title="درآمد ماهانه">
              <BarChartComponent data={activeDataSet.data} dataKey="revenue" color="#8884d8" />
            </ChartContainer>

            <ChartContainer title="تعامل کاربران">
              <LineChartComponent data={activeDataSet.data} dataKey="users" color="#82ca9d" />
            </ChartContainer>

            <ChartContainer title="روند سود">
              <AreaChartComponent data={activeDataSet.data} dataKey="profit" color="#ffc658" />
            </ChartContainer>
            
            <ChartContainer title="توزیع دسته‌بندی محصولات">
              <PieChartComponent data={activeDataSet.pieData} />
            </ChartContainer>

            <ChartContainer title="معیارهای عملکرد">
              <RadarChartComponent data={activeDataSet.data} />
            </ChartContainer>

            <ChartContainer title="نمای دسته‌بندی چندسطحی">
              <TwoLevelPieChartComponent />
            </ChartContainer>

          </div>
        </main>
      </div>
    </div>
  );
};

export default App;