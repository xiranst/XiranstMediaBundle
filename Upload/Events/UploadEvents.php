<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/9/17
 * Time: 11:28 PM
 */

namespace Xiranst\Bundle\MediaBundle\Upload\Events;


final class UploadEvents
{
    const PRE_UPLOAD        = 'xiranst_media.pre_upload';
    const POST_UPLOAD       = 'xiranst_media.post_upload';
    const POST_PERSIST      = 'xiranst_media.post_persist';
    const POST_CHUNK_UPLOAD = 'xiranst_media.post_chunk_upload';
    const VALIDATION        = 'xiranst_media.validation';
}