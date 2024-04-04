<?php include __DIR__ . "/../layout/header.php" ?>

<div class="container mt-4">
    <div class="" style="max-height: 400px; overflow-y: auto">
        <table class="table">
            <thead class="sticky-top">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Check #</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
            </tr>
            </thead>
            <?php if(count($this->transactions)): ?>
                <tbody>
                <?php foreach ($this->transactions as $transaction): ?>
                    <tr>
                        <th scope="row"><?= date("M d, Y", strtotime($transaction->transaction_date)) ?></th>
                        <td><?= $transaction->transaction_check ?></td>
                        <td><?= $transaction->description ?></td>
                        <td class="<?= ($transaction->amount > 0 ? 'text-success' : 'text-danger') ?>"><?= $transaction->amount ?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>

    <div class="mt-3 text-end">
        <h5>Total Income: <?= $this->totalIncome ?></h5>
        <h5>Total Expense: <?= $this->totalExpense ?></h5>
        <h5>Net Total: <?= $this->netTotal ?></h5>
    </div>

</div>

<?php include __DIR__ . "/../layout/footer.php" ?>

