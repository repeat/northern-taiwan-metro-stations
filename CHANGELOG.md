# Changelog

## v2.0

### 新增
- 環狀線資料
- 桃園捷運機場線資料

### 修改
- 使用 [styling features](https://help.github.com/en/github/managing-files-in-a-repository/mapping-geojson-files-on-github#styling-features) 視覺化 GeoJSON
- repository 裡所有 `taipei` 的檔名
- repository 本身的命名

## v1.0

### 新增
- 此一 CHANGELOG.md 檔
- CSV 檔：
 - 根據[地圖](http://www.metro.taipei/public/Attachment/641115315528.jpg)新增 `station_code` 欄位
 - 英譯站名 `station_name_en`

### 修改
- CSV 檔：
 - 多個欄位更名： `line_no` -> `line_code`, `id` -> `construction_id`, `name` -> `station_name_tw`
 - 以數字遞增排序 `station_code` (01 -> 02 -> 03 -> ...)
 - 新北投 (R22A) 併入淡水信義線 (R) 並排列在北投 (R22) 之後；小碧潭 (G03A) 併入松山新店線 (G) 並排列在七張 (G03) 之後。
- PHP 檔：
 - 對應到新的 CSV 欄位。
