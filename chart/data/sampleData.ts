
import type { MonthlyData, PieData } from '../types';

export const salesData: MonthlyData[] = [
  { name: 'فروردین', revenue: 4000, profit: 2400, users: 1200 },
  { name: 'اردیبهشت', revenue: 3000, profit: 1398, users: 1100 },
  { name: 'خرداد', revenue: 2000, profit: 9800, users: 2290 },
  { name: 'تیر', revenue: 2780, profit: 3908, users: 2000 },
  { name: 'مرداد', revenue: 1890, profit: 4800, users: 2181 },
  { name: 'شهریور', revenue: 2390, profit: 3800, users: 2500 },
  { name: 'مهر', revenue: 3490, profit: 4300, users: 2100 },
];

export const userActivityData: MonthlyData[] = [
  { name: 'شنبه', revenue: 2200, profit: 1400, users: 2400 },
  { name: 'یکشنبه', revenue: 1300, profit: 900, users: 2210 },
  { name: 'دوشنبه', revenue: 4500, profit: 3000, users: 2290 },
  { name: 'سه‌شنبه', revenue: 3180, profit: 2208, users: 2000 },
  { name: 'چهارشنبه', revenue: 5890, profit: 4800, users: 2181 },
  { name: 'پنج‌شنبه', revenue: 4390, profit: 3800, users: 2500 },
  { name: 'جمعه', revenue: 4490, profit: 4300, users: 2100 },
];

export const inventoryData: PieData[] = [
  { name: 'الکترونیک', value: 400 },
  { name: 'پوشاک', value: 300 },
  { name: 'خواروبار', value: 300 },
  { name: 'کتاب', value: 200 },
  { name: 'مبلمان', value: 278 },
];

export const marketingData: PieData[] = [
    { name: 'شبکه اجتماعی', value: 550 },
    { name: 'سئو', value: 420 },
    { name: 'ایمیل', value: 280 },
    { name: 'تبلیغات کلیکی', value: 180 },
    { name: 'ارجاعی', value: 120 },
];

export const twoLevelPieInnerData: PieData[] = [
  { name: 'فصل ۱', value: 400 },
  { name: 'فصل ۲', value: 300 },
  { name: 'فصل ۳', value: 300 },
  { name: 'فصل ۴', value: 200 },
];

export const twoLevelPieOuterData: PieData[] = [
  { name: 'آسیا', value: 200 },
  { name: 'اروپا', value: 200 },
  { name: 'آمریکا', value: 150 },
  { name: 'کانادا', value: 150 },
  { name: 'آفریقا', value: 200 },
  { name: 'استرالیا', value: 100 },
  { name: 'اقیانوسیه', value: 200 },
];