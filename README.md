# Covid19ReportSystem


# Kısaca Nedir
- Java, MySQL, PHP Tabanlı bir Covid takip sitesi
- Mevcut Verileri Java tarafından Her 1 Saate bir güncellenip MySQL e aktarılır
- PHP tarafında ise veriler her 1sn de bir kontrol edilir ve güncel olarak gösterilir 

# Kurulum
## 1. Adım

- Xampp'ı çalıştırın
- Apache ve MySQL Start
- Ardından MySQL Admin'e basın
- Açılan sayfada sol tarafda datalar yer alıcak ordan yeni diyip adını 'covidservice' koyun
- Sonra o datayı seçin 
- Yukarıdaki menuden SQL'i şeçin ve Aşağıda verdiğim kodu girin

### 1. Tablo
```
create table generaltable (
    updated bigint(14) NOT NULL,
    country varchar(40) PRIMARY KEY NOT NULL,
    flag varchar(50),
    cases int(11),
    todayCases int(11),
    deaths int(11),
    todayDeaths int(11),
    recovered int(11),
    todayRecovered int(11),
    active int(11),
    critical int(11),
    casesPerOneMillion int(11),
    deathsPerOneMillion int(11),
    tests int(11),
    testsPerOneMillion int(11),
    population int(11),
    continent char(25),
    oneCasePerPeople int(11),
    oneDeathPerPeople int(11),
    oneTestPerPeople int(11),
    activePerOneMillion double,
    recoveredPerOneMillion double,
    criticalPerOneMillion double);
```
### 2. Tablo
```
CREATE TABLE casesPercentage
SELECT country,cases,todayCases, (100*cases)/population AS caseByPop
FROM generaltable;
```

### 3. Tablo
```
CREATE TABLE testsPercentage
SELECT country,tests, (100*tests)/population AS testByPop, (100*cases)/tests AS caseByTest
FROM generaltable;
```

### 4. Tablo
```
CREATE TABLE deathsPercentage
SELECT country, deaths, (100*deaths)/population AS deadByPop, (100*deaths)/cases AS deadByCase
FROM generaltable;
```

### 5. Tablo
```
CREATE TABLE recoveredPercentage
SELECT country, recovered, (100*recovered)/population AS recoverByPop, (100*recovered)/cases AS recoverByCase
FROM generaltable;
```
### 6. Tablo
```
SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag 
FROM casesPercentage AS cp 
JOIN testsPercentage AS tp ON cp.country = tp.country 
JOIN deathsPercentage AS dp ON tp.country = dp.country 
JOIN recoveredPercentage AS rp ON dp.country = rp.country 
JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC
```

- Kodu Girdikten sonra sol tarafta bulunan Git Buttonuna basın
- Tablonuz oluşturuldu

## 2. Adım
- Xampp'ın kurulu oldugu klasorü açın
- 'htdocs' adlı klasorün içini boşaltın ve Github daki PHP dosyasının içindeki 'index.php' ve 'table.php' yi içine atın

## 3. Adım
- IntelliJ IDEA da Open Project diyip Github daki 'Covid19ReportSystem' ü şeçin ve projeyi run layın
- Son olarak Xampp üzerinden  Apache Admin e Tıklayıp test edin 
