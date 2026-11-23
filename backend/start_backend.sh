#!/bin/bash
cd "$(dirname "$0")"
echo "==================================================="
echo "🚀 PT SOSM PROJECT TRACKING - BACKEND SERVER"
echo "==================================================="
echo "Database   : MySQL via XAMPP (pt_sosm_tracking)"
echo "Local URL  : http://localhost:8000/api"
echo "Team IP    : http://192.168.0.110:8000/api"
echo "---------------------------------------------------"
echo "Pastikan MySQL di XAMPP sudah di-START (Port 3306)!"
echo "Tekan Ctrl+C untuk mematikan server."
echo "==================================================="
php artisan serve --host=0.0.0.0 --port=8000
