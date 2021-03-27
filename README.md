# Covid19ReportSystem


# What is Briefly
- Java, MySQL, PHP Based Covid monitoring site
- Existing Data is updated by Java every 1 Hour and transferred to MySQL
- On the PHP side, data is checked every 1 second and displayed up-to-date.

# Setup
## Step 1

- Run xampp
- Apache ve MySQL Start
- Then hit MySQL Manager
- On the page that opens, there will be data on the left, say new and name it 'covidservice'.
- Then select that data
- Select SQL from the menu above and enter the code I gave below

### Table 1
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
### Table 2
```
CREATE TABLE casesPercentage
SELECT country,cases,todayCases, (100*cases)/population AS caseByPop
FROM generaltable;
```

### Table 3
```
CREATE TABLE testsPercentage
SELECT country,tests, (100*tests)/population AS testByPop, (100*cases)/tests AS caseByTest
FROM generaltable;
```

### Table 4
```
CREATE TABLE deathsPercentage
SELECT country, deaths, (100*deaths)/population AS deadByPop, (100*deaths)/cases AS deadByCase
FROM generaltable;
```

### Table 5
```
CREATE TABLE recoveredPercentage
SELECT country, recovered, (100*recovered)/population AS recoverByPop, (100*recovered)/cases AS recoverByCase
FROM generaltable;
```
### Table 6
```
SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag 
FROM casesPercentage AS cp 
JOIN testsPercentage AS tp ON cp.country = tp.country 
JOIN deathsPercentage AS dp ON tp.country = dp.country 
JOIN recoveredPercentage AS rp ON dp.country = rp.country 
JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC
```
### Table 7
```
CREATE TABLE continents(
    continent CHAR(25) PRIMARY KEY NOT NULL,
        cases INT,
        deaths INT,
        recovered INT,
        active INT,
        critical INT,
        tests INT,
        population INT);
```
### Insert 1
```
INSERT INTO continents (continent,cases,deaths,recovered,active,critical,tests,population)
SELECT 
    'Asia',sum(cases),sum(deaths),sum(recovered),sum(active),sum(critical),sum(tests),sum(population)
FROM
    generaltable
WHERE
    generaltable.continent = 'Asia';
```
### Insert 2
```
INSERT INTO continents (continent,cases,deaths,recovered,active,critical,tests,population)
SELECT 
    'Europe',sum(cases),sum(deaths),sum(recovered),sum(active),sum(critical),sum(tests),sum(population)
FROM
    generaltable
WHERE
    generaltable.continent = 'Europe';
```
### Insert 3
```
INSERT INTO continents (continent,cases,deaths,recovered,active,critical,tests,population)
SELECT 
    'North America',sum(cases),sum(deaths),sum(recovered),sum(active),sum(critical),sum(tests),sum(population)
FROM
    generaltable
WHERE
    generaltable.continent = 'North America';
```
### Insert 4
```
INSERT INTO continents (continent,cases,deaths,recovered,active,critical,tests,population)
SELECT 
    'South America',sum(cases),sum(deaths),sum(recovered),sum(active),sum(critical),sum(tests),sum(population)
FROM
    generaltable
WHERE
    generaltable.continent = 'South America';
```
### Insert 5
```
INSERT INTO continents (continent,cases,deaths,recovered,active,critical,tests,population)
SELECT 
    'Africa',sum(cases),sum(deaths),sum(recovered),sum(active),sum(critical),sum(tests),sum(population)
FROM
    generaltable
WHERE
    generaltable.continent = 'Africa';
```
### Insert 6
```
INSERT INTO continents (continent,cases,deaths,recovered,active,critical,tests,population)
SELECT 
    'Australia/Oceania',sum(cases),sum(deaths),sum(recovered),sum(active),sum(critical),sum(tests),sum(population)
FROM
    generaltable
WHERE
    generaltable.continent = 'Australia/Oceania';
```

- After Entering the Code, press the Go Button on the left.
- Your table has been created

## Step 2
- Open the folder where Xampp is installed
- Open the folder named 'htdocs' and put 'index.php' and 'table.php' in the PHP file on Github.

## Step 3
- Say Open Project in IntelliJ IDEA, select 'Covid19ReportSystem' on Github and run the project
- Finally, click on Apache Admin in Xampp and test 
