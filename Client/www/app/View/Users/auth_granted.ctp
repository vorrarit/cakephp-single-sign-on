<?php if (!empty($body)) : ?>
<?php pr($body); ?>
<?php pr($this->Session->read('Auth')); ?>
auth granted
<?php endif; ?>
