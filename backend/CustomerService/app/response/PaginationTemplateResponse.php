<?php

class PaginationTemplateResponse{
    public int $Page;
    public int $TotalRecords;
    public int $TotalPages;
    public int $RecordsByPage;
    public array $Data = [];
}