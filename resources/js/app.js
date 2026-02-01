import './bootstrap';
import Chart from 'chart.js/auto';
window.Chart = Chart; // deixa Chart disponível globalmente
console.log('Chart importado globalmente:', typeof Chart);



import Alpine from 'alpinejs';

window.Alpine = Alpine;


Alpine.start();







