export class Pagination<T> {
    public Page : number = 0;
    public NextPage : number = 0;
    public PriorPage : number = 0;
    public TotalRecords : number = 0;
    public TotalPages : number = 0;
    public RecordsByPage : number = 0;
    public Data : Array<T> = new Array<T>();
}
