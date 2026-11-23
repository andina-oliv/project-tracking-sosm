/**
 * ==============================================================================
 * PT SOSM PROJECT TRACKING DASHBOARD — GOOGLE APPS SCRIPT CLOUD BACKEND
 * ==============================================================================
 * Skrip ini menjadikan Google Spreadsheet Anda sebagai Cloud Database gratis
 * untuk Dashboard PT SOSM, sehingga seluruh tim dapat melihat & mengupdate
 * data proyek secara bersamaan (Multi-User Collaboration).
 *
 * CARA PEMASANGAN (Hanya 2 Menit):
 * 1. Buka Google Sheets baru atau Spreadsheet PT SOSM di Google Drive.
 * 2. Klik menu "Extensions" (Ekstensi) > "Apps Script".
 * 3. Hapus semua kode yang ada, lalu salin (paste) SELURUH KODE di file ini.
 * 4. Klik tombol "Save" (ikon disket / Ctrl+S).
 * 5. Klik tombol "Deploy" (di kanan atas) > "New deployment".
 * 6. Pilih jenis: "Web app" (ikon roda gigi).
 * 7. Atur:
 *    - Description: PT SOSM Dashboard Backend
 *    - Execute as: "Me" (email Anda)
 *    - Who has access: "Anyone" (Siapa saja, agar semua tim kantor bisa akses)
 * 8. Klik "Deploy" dan izinkan akses (Authorize Access).
 * 9. Salin "Web app URL" (akhiran /exec).
 * 10. Buka Dashboard di browser, klik tombol "Team Cloud" di header,
 *     lalu paste URL tersebut dan klik "Save & Connect"!
 * ==============================================================================
 */

function doGet(e) {
  var action = (e && e.parameter && e.parameter.action) || 'read';
  var ss = SpreadsheetApp.getActiveSpreadsheet();
  var sheet = ss.getSheetByName('DashboardData') || ss.insertSheet('DashboardData');
  
  // Jika parameter action=write (dukungan GET write)
  if (action === 'write' && e.parameter.data) {
    var raw = e.parameter.data;
    sheet.getRange(1, 1).setValue(raw);
    sheet.getRange(1, 2).setValue(new Date().toISOString());
    return ContentService.createTextOutput(JSON.stringify({
      status: 'success',
      message: 'Data saved successfully',
      timestamp: new Date().toISOString()
    })).setMimeType(ContentService.MimeType.JSON);
  }

  // Action read (default)
  var cellVal = sheet.getRange(1, 1).getValue();
  var updatedAt = sheet.getRange(1, 2).getValue() || null;
  var data = null;
  if (cellVal) {
    try {
      data = JSON.parse(cellVal);
    } catch (err) {
      data = null;
    }
  }

  return ContentService.createTextOutput(JSON.stringify({
    status: 'success',
    data: data,
    updatedAt: updatedAt
  })).setMimeType(ContentService.MimeType.JSON);
}

function doPost(e) {
  try {
    var ss = SpreadsheetApp.getActiveSpreadsheet();
    var sheet = ss.getSheetByName('DashboardData') || ss.insertSheet('DashboardData');
    var postData = '';

    if (e && e.postData && e.postData.contents) {
      postData = e.postData.contents;
    } else if (e && e.parameter && e.parameter.data) {
      postData = e.parameter.data;
    }

    if (!postData) {
      return ContentService.createTextOutput(JSON.stringify({
        status: 'error',
        message: 'No data received'
      })).setMimeType(ContentService.MimeType.JSON);
    }

    // Validasi JSON
    var parsed = JSON.parse(postData);
    sheet.getRange(1, 1).setValue(postData);
    sheet.getRange(1, 2).setValue(new Date().toISOString());

    // Opsional: perbarui juga sheet rekuman tabular agar tim bisa melihat data di spreadsheet
    syncTabularSheets(ss, parsed);

    return ContentService.createTextOutput(JSON.stringify({
      status: 'success',
      message: 'Data updated successfully',
      timestamp: new Date().toISOString()
    })).setMimeType(ContentService.MimeType.JSON);

  } catch (err) {
    return ContentService.createTextOutput(JSON.stringify({
      status: 'error',
      message: err.toString()
    })).setMimeType(ContentService.MimeType.JSON);
  }
}

/**
 * Menyusun data ke dalam Sheet Tabular agar tim juga bisa membaca data langsung di Google Spreadsheet
 */
function syncTabularSheets(ss, data) {
  try {
    if (data.recruitment && Array.isArray(data.recruitment)) {
      var rSheet = ss.getSheetByName('Recruitment_Live') || ss.insertSheet('Recruitment_Live');
      var rHeaders = ['No', 'Date', 'Project Name', 'Principal', 'PIC', 'Activities', 'Drf', 'Rev', 'Sub', 'Int', 'App', 'Doc', 'Dep', 'Remark'];
      var rRows = [rHeaders];
      data.recruitment.forEach(function(p) {
        rRows.push([
          p.no,
          p.date || '',
          p.name || '',
          p.principal || '',
          p.pic || '',
          p.activities || '',
          p.stages && p.stages[0] ? 'V' : '',
          p.stages && p.stages[1] ? 'V' : '',
          p.stages && p.stages[2] ? 'V' : '',
          p.stages && p.stages[3] ? 'V' : '',
          p.stages && p.stages[4] ? 'V' : '',
          p.stages && p.stages[5] ? 'V' : '',
          p.stages && p.stages[6] ? 'V' : '',
          p.remark || ''
        ]);
      });
      rSheet.clear();
      rSheet.getRange(1, 1, rRows.length, rHeaders.length).setValues(rRows);
      rSheet.getRange(1, 1, 1, rHeaders.length).setFontWeight('bold').setBackground('#e2e8f0');
    }

    if (data.adm && Array.isArray(data.adm)) {
      var aSheet = ss.getSheetByName('ADM_Live') || ss.insertSheet('ADM_Live');
      var aHeaders = ['No', 'Date', 'Project Name', 'Principal', 'PIC', 'Activities', 'Col', 'Drf', 'Rev', 'Sub', 'App', 'Inv', 'Eml', 'Remark'];
      var aRows = [aHeaders];
      data.adm.forEach(function(p) {
        aRows.push([
          p.no,
          p.date || '',
          p.name || '',
          p.principal || '',
          p.pic || '',
          p.activities || '',
          p.stages && p.stages[0] ? 'V' : '',
          p.stages && p.stages[1] ? 'V' : '',
          p.stages && p.stages[2] ? 'V' : '',
          p.stages && p.stages[3] ? 'V' : '',
          p.stages && p.stages[4] ? 'V' : '',
          p.stages && p.stages[5] ? 'V' : '',
          p.stages && p.stages[6] ? 'V' : '',
          p.remark || ''
        ]);
      });
      aSheet.clear();
      aSheet.getRange(1, 1, aRows.length, aHeaders.length).setValues(aRows);
      aSheet.getRange(1, 1, 1, aHeaders.length).setFontWeight('bold').setBackground('#e2e8f0');
    }
  } catch (e) {
    // Abaikan jika tabular gagal, JSON utama tetap tersimpan aman
  }
}
