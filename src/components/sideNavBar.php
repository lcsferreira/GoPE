<div class="side-nav">
  <ul class="side-nav__links">
    <li <?php if (basename($_SERVER['PHP_SELF']) == "demographicData.php") echo 'class="selected"' ?>><a
        href="../../../src/pages/Indicators/demographicData.php?id=<?php echo $_GET["id"]; ?>">Country and Demographic
        data</a></li>
    <li <?php if (basename($_SERVER['PHP_SELF']) == "paPrevalence.php") echo 'class="selected"' ?>><a
        href="../../../src/pages/Indicators/paPrevalence.php?id=<?php echo $_GET["id"]; ?>">Physical activity
        particpation</a></li>
    <li <?php if (basename($_SERVER['PHP_SELF']) == "pePolicy.php") echo 'class="selected"' ?>><a
        href="../../../src/pages/Indicators/pePolicy.php?id=<?php echo $_GET["id"]; ?>">Physical education
        policy</a></li>
    <li <?php if (basename($_SERVER['PHP_SELF']) == "peMonitoring.php") echo 'class="selected"' ?>><a
        href="../../../src/pages/Indicators/peMonitoring.php?id=<?php echo $_GET["id"]; ?>">Physical education
        monitoring</a></li>
    <li <?php if (basename($_SERVER['PHP_SELF']) == "researchPe.php") echo 'class="selected"' ?>><a
        href="../../../src/pages/Indicators/researchPe.php?id=<?php echo $_GET["id"]; ?>">Research in
        PE and school-based PA</a></li>
    <li <?php if (basename($_SERVER['PHP_SELF']) == "conclusion.php") echo 'class="selected"' ?>><a
        href="../../../src/pages/Indicators/conclusion.php?id=<?php echo $_GET["id"]; ?>">Conclusion</a></li>
  </ul>
</div>