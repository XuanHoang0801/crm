<?php 
namespace common\units;

use Yii;
use Exception;
use yii\db\Expression;
use yii\base\UserException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BaseUnits {
    
    public static function exportExcel($queryParams, $searchClass, $title, $fields, $fileName) {
        ob_start();
        $searchModel = new $searchClass();
        $dataProvider = $searchModel->search($queryParams);
        
        // $sort = $dataProvider->getSort();
        // $sort->params = ['sort' => $queryParams['sort']];
        // $dataProvider->setSort($sort);
        $styleArray = array(
        'font' => array(
        'size' => 14,
        'name' => 'Times NewRoman'
        ));
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->applyFromArray($styleArray);
        
        $spreadsheet->getProperties()->setTitle($title);
        $spreadsheet->getProperties()->setDescription($title);
        
        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();
        
        $activeSheet->setCellValue('A1', mb_strtoupper($title, 'UTF-8'));
        $lastColumnName = Coordinate::stringFromColumnIndex(sizeof($fields) + 1);
        $activeSheet->mergeCells('A1:' . $lastColumnName . '1');
        $activeSheet->getRowDimension('1')->setRowHeight(40);
        $activeSheet->getStyle('A1')->applyFromArray([
        'font' => [
        'bold' => true, 'size' => 18
        ],
        'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        ]
        ]);
        
        $exportData = $dataProvider;
        $exportData->setPagination(false);
        $dataStartRowIndex = 2;
        $spreadsheet->getActiveSheet()->setCellValue("A$dataStartRowIndex", 'STT');
        // spreadsheet coi cột A là 1
        $columnIndex = 2;
        
        // viết tiêu đề cho cột
        foreach ($fields as $field) {
        $columnName = Coordinate::stringFromColumnIndex($columnIndex++);
        $headerText = isset($field['label']) ? $field['label'] : $searchModel->getAttributeLabel($field['attribute']);
        $spreadsheet->getActiveSheet()->setCellValue("$columnName$dataStartRowIndex", $headerText);
        }
        
        // bôi đạm tiêu đề các cột
        $spreadsheet->getActiveSheet()->getStyle("A$dataStartRowIndex:$lastColumnName$dataStartRowIndex")->applyFromArray(
        [
        'font' => [
        'bold' => true
        ],
        'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        ]
        ]
        );
        
        $row = 2;
        $order = 1;
        
        foreach ($exportData->models as $model) {
        $spreadsheet->getActiveSheet()->SetCellValue('A' . strval($row + 1), $order++);
        $columnIndex = 2;
        
        //var_dump($fields);die();
        
        foreach ($fields as $field) {
        $columnName = Coordinate::stringFromColumnIndex($columnIndex++);
        $fieldName = $field['attribute'];
        if (isset($field['value'])) {
        $value = call_user_func($field['value'], $model);
        } else {
        $value = $model[$fieldName];
        }
        
        $spreadsheet->getActiveSheet()->setCellValue($columnName . strval($row + 1), $value);
        }
        
        $row++;
        }
        
        $spreadsheet->getActiveSheet()->getStyle('A2:A' . $spreadsheet->getActiveSheet()->getHighestRow())->applyFromArray([
        'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        ]
        ]);
        
        $spreadsheet->getActiveSheet()->getRowDimension($dataStartRowIndex)->setRowHeight(40);
        
        foreach ($fields as $field) {
        $columnName = Coordinate::stringFromColumnIndex($columnIndex++);
        $spreadsheet->getActiveSheet()->getColumnDimension($columnName)->setWidth(30);
        }
        
        $spreadsheet->getActiveSheet()->getStyle('A' . ($dataStartRowIndex + 1) . ':' . $lastColumnName . $spreadsheet->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle('B' . ($dataStartRowIndex + 1) . ':' . $lastColumnName . $spreadsheet->getActiveSheet()->getHighestRow())->applyFromArray([
        'alignment' => [
        'vertical' => Alignment::VERTICAL_TOP,
        ]
        ]);
        
        $spreadsheet
        ->getActiveSheet()
        ->getStyle("A$dataStartRowIndex:$lastColumnName" . $spreadsheet->getActiveSheet()->getHighestRow())
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);
        
        $sysdate = new Expression(date('Y-m-d'));
        $fileName = $fileName . '_' . $sysdate . '.xlsx';
        try {
        $writer = new Xlsx($spreadsheet);
        $writer->save('uploads' . DIRECTORY_SEPARATOR . $fileName);
        Yii::$app->response->sendFile('uploads' . DIRECTORY_SEPARATOR . $fileName)->send();
        } catch (Exception $e) {
        throw new UserException($e->getMessage());
        }
        try {
        unlink('uploads' . DIRECTORY_SEPARATOR . $fileName);
        } catch (Exception $e) {
        throw new UserException($e->getMessage());
        }
    }

    public static function generateDateTimeFileName($prefix, $ext) {
        $now = strtotime('now');
        $fileName = $prefix . '_' . date("Y-m-d-H-i-s", time()) . '-' . $now . '.' . $ext;
        return $fileName;
    }

    public static function exportExcelTemp($title, $fields, $fileName, $arrayData) {
        ob_start();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle($title);
        $spreadsheet->getProperties()->setDescription($title);
        
        $spreadsheet->setActiveSheetIndex(0);
        $dataStartRowIndex = 1;
        // spreadsheet coi cột A là 1
        $columnIndex = 1;
        
        // viết tiêu đề cho cột
        foreach ($fields as $field) {
        $columnName = Coordinate::stringFromColumnIndex($columnIndex++);
        $headerText = isset($field['label']) ? $field['label'] : $field['attribute'];
        $spreadsheet->getActiveSheet()->setCellValue("$columnName$dataStartRowIndex", $headerText);
        }
        
        $row = 1;
        $order = 1;
        
        foreach ($arrayData as $model) {
        $spreadsheet->getActiveSheet()->SetCellValue('A' . strval($row + 1), $order++);
        $columnIndex = 1;
        
        foreach ($fields as $field) {
        $columnName = Coordinate::stringFromColumnIndex($columnIndex++);
        $value = $model[$field['attribute']];
        $spreadsheet->getActiveSheet()->getColumnDimension($columnName)->setWidth(30);
        $spreadsheet->getActiveSheet()->setCellValue($columnName . strval($row + 1), $value);
        }
        
        $row++;
        }
        
        $column = chr(count($fields) - 1 + 65);
        $spreadsheet->getActiveSheet()->getStyle('A2:' . $column . $spreadsheet->getActiveSheet()->getHighestRow())->applyFromArray([
        'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        ], 'font' => [
        'size' => 10
        ],
        ]);
        
        $sysdate = new Expression(date('Y-m-d'));
        $fileName = $fileName . '_' . $sysdate . '.xlsx';
        try {
        $writer = new Xlsx($spreadsheet);
        $writer->save('uploads' . DIRECTORY_SEPARATOR . $fileName);
        Yii::$app->response->sendFile('uploads' . DIRECTORY_SEPARATOR . $fileName)->send();
        } catch (Exception $e) {
        throw new UserException($e->getMessage());
        }
        try {
        unlink('uploads' . DIRECTORY_SEPARATOR . $fileName);
        } catch (Exception $e) {
        throw new UserException($e->getMessage());
        }
    }
        
        
}