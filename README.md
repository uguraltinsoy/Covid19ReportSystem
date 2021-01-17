# Covid19ReportSystem

## 1. Adım
```
- Xampp'ı çalıştırın
- Apache ve MySQL Start
- Ardından MySQL Admin'e basın
- Açılan sayfada sol tarafda datalar yer alıcak ordan yeni diyip adını 'covidservice' koyun
- Sonra o datayı seçin 
- Yukarıdaki menuden SQL'i şeçin ve Aşağıda verdiğim kodu girin
```
```
CREATE TABLE generaltable (
    updated INT NOT NULL,
    country VARCHAR(40) PRIMARY KEY NOT NULL,
    flag VARCHAR(50),
    cases INT,
    todayCases INT,
    deaths INT,
    todayDeaths INT,
    recovered INT,
    todayRecovered INT,
    active INT,
    critical INT,
    casesPerOneMillion INT,
    deathsPerOneMillion INT,
    tests INT,
    testsPerOneMillion INT,
    population INT,
    continent CHAR(25),
    oneCasePerPeople INT,
    oneDeathPerPeople INT,
    oneTestPerPeople INT,
    activePerOneMillion DOUBLE,
    recoveredPerOneMillion DOUBLE,
    criticalPerOneMillion DOUBLE);
```

```
- Kodu Girdikten sonra sol tarafta bulunan Git Buttonuna basın
- Tablonuz oluşturuldu
```

## 2. Adım
```
- Xampp'ın kurulu oldugu klasorü açın
- 'htdocs' adlı klasorün içini boşaltın ve Github daki PHP dosyasının içindeki 'index.php' yi içine atın
```

## 3. Adım
```
- IntelliJ IDEA da Open Project diyip Github daki 'Covid19ReportSystem' ü şeçin ve projeyi run layın
- Son olarak Xampp üzerinden  Apache Admin e Tıklayıp test edin	
```
