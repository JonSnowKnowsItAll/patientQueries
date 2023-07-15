<h1>Patienten - Diagnosen</h1>
<?php
if (isset($_POST['show']))
{
    if ($_POST['svnr'] < 1000 or $_POST['svnr'] > 9999)
    {
        echo '<h6 style="color:indianred">Falsches Format bei SV-Nr.!</h6>';
        ?>
        <form>
            <button class="btn btn-outline-secondary" type="submit" name="zurück">zurück</button>
        </form>
        <?php
    }
    else
    {
        if ($_POST['start'] != null or $_POST['ende'] != null)
        {
            $svnr = $_POST['svnr'];
            $gebdat = $_POST['gebdat'];
            $start = $_POST['start'];
            $ende = $_POST['ende'];

            echo '<h5>Suchkriterien:</h5>';
            echo '<h6>SV-Nr.: '.$svnr.'</h6>';
            echo '<h6>Geburtsdatum: '.$gebdat.'</h6>';
            echo '<h6>Startzeitraum: '.$start.'</h6>';
            echo '<h6>Zeitraum Ende: '.$ende.'</h6>';

            $getPatStmt = 'select p.per_id as ID, concat_ws(" ", p.per_vname, p.per_nname) as Patient, p.per_svnr as SVNR, p.per_geburt as Geburtstdatum,
                               d.dia_name as Diagnose, concat_ws(" - ", b.ter_beginn, b.ter_ende) as Zeitraum
                          from person p, behandlungszeitraum b, diagnose d
                         where p.per_id = b.per_id
                           and d.dia_id = b.dia_id
                           and p.per_svnr = '.$svnr.'
                           and cast(p.per_geburt as date) = cast("'.$gebdat.'" as date)
                           and cast(b.ter_beginn as date) between ifnull(cast("'.$start.'" as date), "") and ifnull(cast("'.$ende.'" as date), now())';

            $result = makeStatement($getPatStmt);

            if ($count = $result->rowCount() == 0)
            {
                echo '<h6 style="color:indianred">Es sind keine Datensätze vorhanden!</h6><br>';
                ?>
                <form>
                    <button class="btn btn-outline-secondary" type="submit" name="zurück">zurück</button>
                </form>
                <?php
            }
            else
            {
                showTable($getPatStmt);
                ?>
                <form>
                    <button class="btn btn-outline-secondary" type="submit" name="zurück">zurück</button>
                </form>
                <?php
            }
        }
        else
        {
            $svnr = $_POST['svnr'];
            $gebdat = $_POST['gebdat'];

            echo '<h5>Suchkriterien:</h5>';
            echo '<h6>SV-Nr.: '.$svnr.'</h6>';
            echo '<h6>Geburtsdatum: '.$gebdat.'</h6>';

            $getPatStmt = 'select p.per_id as ID, concat_ws(" ", p.per_vname, p.per_nname) as Patient, p.per_svnr as SVNR, 
                                   d.dia_name as Diagnose, concat_ws(" - ", b.ter_beginn, b.ter_ende) as Zeitraum
                              from person p, behandlungszeitraum b, diagnose d
                             where p.per_id = b.per_id
                               and d.dia_id = b.dia_id
                               and p.per_svnr = '.$svnr.'
                               and cast(p.per_geburt as date) = cast("'.$gebdat.'" as date)';

            $result = makeStatement($getPatStmt);

            if ($count = $result->rowCount() == 0)
            {
                echo '<h6 style="color:indianred">Es sind keine Datensätze vorhanden!</h6><br>';
                ?>
                <form>
                    <button class="btn btn-outline-secondary" type="submit" name="zurück">zurück</button>
                </form>
                <?php
            }
            else
            {
                showTable($getPatStmt);
                ?>
                <form>
                    <button class="btn btn-outline-secondary" type="submit" name="zurück">zurück</button>
                </form>
                <?php
            }
        }
    }
}
else
{
    ?>
<br>
<form method="post">
    <div class="row">
        <div class="col-6">
            <label for="svnr">SV-Nr.</label>
            <input type="text" name="svnr" class="form-control" required placeholder="Format: xxxx z.B. 1234">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-2">
            <label for="gebdat">Geburtstdatum</label>
            <input type="date" name="gebdat" class="form-control" required>
        </div>
    </div>
    <br>
    <h1>Behandlungszeitraum</h1>
    <br>
    <div class="row">
        <div class="col-2">
            <label for="start">Start</label>
            <input type="date" name="start" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-2">
            <label for="ende">Ende</label>
            <input type="date" name="ende" class="form-control">
        </div>
    </div>
    <br>
    <button class="btn btn-outline-success" name="show">anzeigen</button>
</form>
    <?php
}

