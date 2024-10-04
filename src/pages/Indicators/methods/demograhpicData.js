const methods = [
  {
    name: "country",
    title: "Country name",
    html: "<p>We used the World Bank list of 215 countries, except that we divided the United Kingdom into England, Scotland, Wales, and Northern Ireland. Also, we combined information from China and Taiwan as the Greater China Area, and merged Palestine and West Bank and Gaza as requested by the GoPA! representatives from these countries. The Cook Islands was added as a new country. Therefore, our list includes 218 countries.</p><p><strong>New classification by income level (available year 2022):</strong></p><p><a href='https://datahelpdesk.worldbank.org/knowledgebase/articles/906519-world-bankcountry-and-lending-groups'>World Bank country and lending groups</a></p>",
  },
  {
    name: "capital",
    title: "Capital city name",
    html: "<p><strong>Most recent geography country data (available year 2024):</strong><br><a href='https://geographyfieldwork.com/WorldCapitalCities.htm'>Geography Fieldwork: World Capital Cities</a><br><a href='https://www.worlddata.info/capital-cities.php'>World Data: Capital Cities</a></p>",
  },
  {
    name: "total_population",
    title: "Total population (n)",
    html: "<p><strong>Most recent data from the World Bank (available year 2022):</strong><br><a href='http://data.worldbank.org/indicator/SP.POP.TOTL/countries/CO?display=default'>World Bank: Total Population</a><br><strong>Country-specific data (available year 2023):</strong><br>- Cook Islands<br><a href='https://sdd.spc.int/ck'>Cook Islands Statistics</a><br>- England, Northern Ireland, Scotland, and Wales (available mid-year estimate 2022):<br><a href='https://www.ons.gov.uk/peoplepopulationandcommunity/populationandmigration/populationestimates'>ONS: Population Estimates</a><br><strong>National statistics (available 2020-2023):</strong><br>- Afghanistan, Andorra, Austria, Belarus, Brunei Darussalam, China, Finland, France, Italy, Latvia, Luxembourg, Malawi, Mexico, Nigeria, Panama, Peru, Puerto Rico, Saudi Arabia, Scotland, Senegal, Singapore, Slovak Republic, Slovenia, Suriname, Sweden, Switzerland, Timor-Leste, Tonga, Trinidad and Tobago, Uruguay, Zimbabwe</p>",
  },
  {
    name: "literacy_youth_total",
    title: "Literacy youth total (15 to 24 years) (%)",
    html: "<p>Most recent data from the World Bank, for “Literacy rate, youth total (% of people ages 15-24)”.<br><a href='https://data.worldbank.org/indicator/SE.ADT.1524.LT.ZS'>World Bank: Literacy rate, youth total (% of people ages 15-24)</a><br>For Argentina, Bahrain, Greece, Malaysia, San Marino, most recent data from the UNICEF Global database on literacy rate, for “Youth literacy rate, aged 15-24”.<br><a href='https://data.unicef.org/wp-content/uploads/2021/04/Literacy-rate_2021-1.xlsx'>https://data.unicef.org/wp-content/uploads/2021/04/Literacy-rate_2021-1.xlsx</a><br>[accessed in April 23rd, 2024]</p>",
  },
  {
    name: "gov_expenditure_education",
    title: "Government expenditure on education",
    html: "<p>Most recent data from the World Bank, for “Government expenditure on education, total (% of GDP)”.<br><a href='https://data.worldbank.org/indicator/SE.XPD.TOTL.GD.ZS'>World Bank: Government expenditure on education, total (% of GDP)</a><br>[accessed in April 23rd, 2024]</p>",
  },
  {
    name: "entrance_age_pe",
    title: "Official entrance age to primary education (years)",
    html: "<p>Most recent data from the UNESCO Institute for Statistics. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Official entrance age and theoretical duration of each level of education (years)’ – ‘Official entrance age’ – ‘Official entrance age of each ISCED level of education’. On the available table, select ‘Official entrance age to primary education (years)’.<br>Use the same value as in 'Official entrance age to primary education (years)'. For ‘primary education’ we use as reference The ISCED level 1 (primary education) that usually begins between four and seven years of age, is compulsory in all countries and generally lasts from five to six years (UNESCO, 2012).<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 23rd, 2024]<br><br>For England and Scotland:<br>- OECD. (2023). Education at a Glance 2023: OECD indicators. OECD Publishing.<br><a href='https://doi.org/10.1787/e13bef63-en'>https://doi.org/10.1787/e13bef63-en</a></p>",
  },
  {
    name: "entrance_age_se",
    title: "Official entrance age to secondary education (years)",
    html: "<p>Most recent data from the UNESCO Institute for Statistics. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Official entrance age and theoretical duration of each level of education (years)’ – ‘Official entrance age’ – ‘Official entrance age of each ISCED level of education’. On the available table, select ‘Official entrance age to lower secondary education (years)’.<br>Use the same value as in 'Official entrance age to lower secondary education (years)'. For ‘secondary education’ we use as reference the ISCED 2 and ISCED 3 levels. Programs classified at ISCED level 2 (lower secondary education) may be referred to in many ways, for example: secondary school (stage one/lower grades if there is one program that spans ISCED levels 2 and 3). Programs at ISCED level 3, or upper secondary education, are typically designed to complete secondary education in preparation for tertiary education or provide skills relevant to employment, or both (UNESCO, 2012).<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 23rd, 2024]</p>",
  },
  {
    name: "duration_pe",
    title: "Duration of primary education (years)",
    html: "<p>Most recent data from the UNESCO Institute for Statistics. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Official entrance age and theoretical duration of each level of education (years)’ – ‘Theoretical duration’ – ‘Duration by level of education’. On the available table, select ‘Duration of primary education (years)’.<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 23rd, 2024]<br><br>For England and Scotland:<br>- OECD. (2023). Education at a Glance 2023: OECD indicators. OECD Publishing.<br><a href='https://doi.org/10.1787/e13bef63-en'>https://doi.org/10.1787/e13bef63-en</a></p>",
  },
  {
    name: "duration_se",
    title: "Duration of secondary education (years)",
    html: "<p>UNESCO. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Official entrance age and theoretical duration of each level of education (years)’ – ‘Theoretical duration’ – ‘Duration by level of education’. On the available table, select ‘Duration of secondary education (years)’.<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 23rd, 2024]</p>",
  },
  {
    name: "duration_ce",
    title: "Duration of compulsory education (years)",
    html: "<p>Most recent data from the UNESCO Institute for Statistics. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Official entrance age and theoretical duration of each level of education (years)’ – ‘Theoretical duration’ – ‘Duration by level of education’. On the available table, select ‘Duration of compulsory education (years)’.<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 23rd, 2024]<br><br>For England and Scotland:<br>- OECD. (2023). Education at a Glance 2023: OECD indicators. OECD Publishing.<br><a href='https://doi.org/10.1787/e13bef63-en'>https://doi.org/10.1787/e13bef63-en</a></p>",
  },
  {
    name: "duration_compulsory_pe",
    title:
      "Duration of the compulsory school years of primary education (years)",
    html: "<p>Most recent country-specific information from official governmental and Ministry of Education sources, international reports and monitoring systems related to education and Physical Education.</p>",
  },
  {
    name: "duration_compulsory_se",
    title:
      "Duration of the compulsory school years of secondary education (years)",
    html: "<p>Most recent country-specific information from official governmental and Ministry of Education sources, international reports and monitoring systems related to education and Physical Education.</p>",
  },
  {
    name: "school_age_pe",
    title: "School-age population at primary education (n)",
    html: "<p>Most recent data from the UNESCO Institute for Statistics. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Population of the official age/school age population’ – ‘School age population by level of education’. On the available table, select ‘School age population, primary education, both sexes (number)’.<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 24th, 2024]</p>",
  },
  {
    name: "school_age_se",
    title: "School-age population at secondary education (n)",
    html: "<p>Most recent data from the UNESCO Institute for Statistics. To find the information, enter the provided link and follow these steps: on the main page, select ‘Education’ – ‘Other policy relevant indicators’ – ‘Population of the official age/school age population’ – ‘School age population by level of education’. On the available table, select ‘School age population, secondary education, both sexes (number)’.<br><a href='http://data.uis.unesco.org/'>http://data.uis.unesco.org/</a><br>[accessed in April 24th, 2024]</p>",
  },
];
