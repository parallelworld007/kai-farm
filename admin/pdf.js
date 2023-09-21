import jsPDF from 'jspdf';

// เมื่อคลิกปุ่ม "บันทึกเป็น PDF"
document.getElementById('saveAsPDF').addEventListener('click', () => {
    // สร้างอ็อบเจ็กต์ของเอกสาร PDF
    const pdf = new jsPDF();

    // เพิ่มเนื้อหาของหน้าเว็บลงในเอกสาร PDF
    const content = document.body;
    pdf.html(content, {
        callback: function(pdf) {
            // บันทึกเอกสาร PDF ลงในไฟล์
            pdf.save('หน้าเว็บเป็น PDF.pdf');
        }
    });
});