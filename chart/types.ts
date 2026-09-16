
export interface MonthlyData {
  name: string;
  revenue: number;
  profit: number;
  users: number;
}

export interface PieData {
  name: string;
  value: number;
}

export interface DataSet {
  id: string;
  name: string;
  data: MonthlyData[];
  pieData: PieData[];
}
