//---------------------------------------------------------------------------------------------------------------------------------
// File: sal_def.h
//
// Contents: Contains the minimal definitions to build on non-Windows platforms
//
// Microsoft Drivers 5.7 for PHP for SQL Server
// Copyright(c) Microsoft Corporation
// All rights reserved.
// MIT License
// Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files(the ""Software""), 
//  to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
//  and / or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions :
// The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
// THE SOFTWARE IS PROVIDED *AS IS*, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
//  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
//  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
//  IN THE SOFTWARE.
//---------------------------------------------------------------------------------------------------------------------------------

#ifndef XPLAT_SAL_DEFINED
#define XPLAT_SAL_DEFINED

#define __allocator 
#define __analysis_assert(e)
#define __analysis_assume(e)
#define __bcount(size)
#define __bcount_opt(size)
#define __blocksOn(resource)
#define __bound 
#define __callback 
#define __checkReturn 
#define __control_entrypoint(category)
#define __data_entrypoint(category)
#define __deref
#define __deref_bcount(size)
#define __deref_bcount_opt(size)
#define __deref_ecount(size)
#define __deref_ecount_opt(size)
#define __deref_in
#define __deref_in
#define __deref_in_bcount(size)
#define __deref_in_bcount_opt(size)
#define __deref_in_ecount(size)
#define __deref_in_ecount_opt(size)
#define __deref_in_opt
#define __deref_in_range(lb,ub)
#define __deref_in_xcount(size)
#define __deref_in_xcount_opt(size)
#define __deref_inout
#define __deref_inout_bcount(size)
#define __deref_inout_bcount_full(size)
#define __deref_inout_bcount_full_opt(size)
#define __deref_inout_bcount_nz(size)
#define __deref_inout_bcount_nz_opt(size)
#define __deref_inout_bcount_opt(size)
#define __deref_inout_bcount_part(size,length)
#define __deref_inout_bcount_part_opt(size,length)
#define __deref_inout_bcount_z(size)
#define __deref_inout_bcount_z_opt(size)
#define __deref_inout_ecount(size)
#define __deref_inout_ecount_full(size)
#define __deref_inout_ecount_full_opt(size)
#define __deref_inout_ecount_nz(size)
#define __deref_inout_ecount_nz_opt(size)
#define __deref_inout_ecount_opt(size)
#define __deref_inout_ecount_part(size,length)
#define __deref_inout_ecount_part_opt(size,length)
#define __deref_inout_ecount_z(size)
#define __deref_inout_ecount_z_opt(size)
#define __deref_inout_nz 
#define __deref_inout_nz_opt 
#define __deref_inout_opt 
#define __deref_inout_xcount(size)
#define __deref_inout_xcount_full(size)
#define __deref_inout_xcount_full_opt(size)
#define __deref_inout_xcount_opt(size)
#define __deref_inout_xcount_part(size,length)
#define __deref_inout_xcount_part_opt(size,length)
#define __deref_inout_z 
#define __deref_inout_z_opt 
#define __deref_opt_bcount(size)
#define __deref_opt_bcount_opt(size)
#define __deref_opt_ecount(size)
#define __deref_opt_ecount_opt(size)
#define __deref_opt_in
#define __deref_opt_in_bcount(size)
#define __deref_opt_in_bcount_opt(size)
#define __deref_opt_in_ecount(size)
#define __deref_opt_in_ecount_opt(size)
#define __deref_opt_in_opt
#define __deref_opt_in_xcount(size)
#define __deref_opt_in_xcount_opt(size)
#define __deref_opt_inout 
#define __deref_opt_inout_bcount(size)
#define __deref_opt_inout_bcount_full(size)
#define __deref_opt_inout_bcount_full_opt(size)
#define __deref_opt_inout_bcount_nz(size)
#define __deref_opt_inout_bcount_nz_opt(size)
#define __deref_opt_inout_bcount_opt(size)
#define __deref_opt_inout_bcount_part(size,length)
#define __deref_opt_inout_bcount_part_opt(size,length)
#define __deref_opt_inout_bcount_z(size)
#define __deref_opt_inout_bcount_z_opt(size)
#define __deref_opt_inout_ecount(size)
#define __deref_opt_inout_ecount_full(size)
#define __deref_opt_inout_ecount_full_opt(size)
#define __deref_opt_inout_ecount_nz(size)
#define __deref_opt_inout_ecount_nz_opt(size)
#define __deref_opt_inout_ecount_opt(size)
#define __deref_opt_inout_ecount_part(size,length)
#define __deref_opt_inout_ecount_part_opt(size,length)
#define __deref_opt_inout_ecount_z(size)
#define __deref_opt_inout_ecount_z_opt(size)
#define __deref_opt_inout_nz
#define __deref_opt_inout_nz_opt
#define __deref_opt_inout_opt
#define __deref_opt_inout_xcount(size)
#define __deref_opt_inout_xcount_full(size)
#define __deref_opt_inout_xcount_full_opt(size)
#define __deref_opt_inout_xcount_opt(size)
#define __deref_opt_inout_xcount_part(size,length)
#define __deref_opt_inout_xcount_part_opt(size,length)
#define __deref_opt_inout_z 
#define __deref_opt_inout_z_opt
#define __deref_opt_out 
#define __deref_opt_out_bcount(size)
#define __deref_opt_out_bcount_full(size)
#define __deref_opt_out_bcount_full_opt(size)
#define __deref_opt_out_bcount_nz_opt(size)
#define __deref_opt_out_bcount_opt(size)
#define __deref_opt_out_bcount_part(size,length)
#define __deref_opt_out_bcount_part_opt(size,length)
#define __deref_opt_out_bcount_z_opt(size)
#define __deref_opt_out_ecount(size)
#define __deref_opt_out_ecount_full(size)
#define __deref_opt_out_ecount_full_opt(size)
#define __deref_opt_out_ecount_nz_opt(size)
#define __deref_opt_out_ecount_opt(size)
#define __deref_opt_out_ecount_part(size,length)
#define __deref_opt_out_ecount_part_opt(size,length)
#define __deref_opt_out_ecount_z_opt(size)
#define __deref_opt_out_nz_opt
#define __deref_opt_out_opt
#define __deref_opt_out_xcount(size)
#define __deref_opt_out_xcount_full(size)
#define __deref_opt_out_xcount_full_opt(size)
#define __deref_opt_out_xcount_opt(size)
#define __deref_opt_out_xcount_part(size,length)
#define __deref_opt_out_xcount_part_opt(size,length)
#define __deref_opt_out_z 
#define __deref_opt_out_z_opt
#define __deref_opt_xcount(size)
#define __deref_opt_xcount_opt(size)
#define __deref_out 
#define __deref_out_bcount(size)
#define __deref_out_bcount_full(size)
#define __deref_out_bcount_full_opt(size)
#define __deref_out_bcount_nz(size)
#define __deref_out_bcount_nz_opt(size)
#define __deref_out_bcount_opt(size)
#define __deref_out_bcount_part(size,length)
#define __deref_out_bcount_part_opt(size,length)
#define __deref_out_bcount_z(size)
#define __deref_out_bcount_z_opt(size)
#define __deref_out_bound 
#define __deref_out_ecount(size)
#define __deref_out_ecount_full(size)
#define __deref_out_ecount_full_opt(size)
#define __deref_out_ecount_nz(size)
#define __deref_out_ecount_nz_opt(size)
#define __deref_out_ecount_opt(size)
#define __deref_out_ecount_part(size,length)
#define __deref_out_ecount_part_opt(size,length)
#define __deref_out_ecount_z(size)
#define __deref_out_ecount_z_opt(size)
#define __deref_out_nz 
#define __deref_out_nz_opt 
#define __deref_out_opt 
#define __deref_out_range(lb,ub)
#define __deref_out_xcount(size)
#define __deref_out_xcount_full(size)
#define __deref_out_xcount_full_opt(size)
#define __deref_out_xcount_opt(size)
#define __deref_out_xcount_part(size,length)
#define __deref_out_xcount_part_opt(size,length)
#define __deref_out_z 
#define __deref_out_z_opt 
#define __deref_xcount(size)
#define __deref_xcount_opt(size)
#define __ecount(size)
#define __ecount_opt(size)
#define __fallthrough
#define __field_bcount(size)
#define __field_bcount_full(size)
#define __field_bcount_full_opt(size)
#define __field_bcount_opt(size)
#define __field_bcount_part(size,init)
#define __field_bcount_part_opt(size,init)
#define __field_data_source(src_sym)
#define __field_ecount(size)
#define __field_ecount_full(size)
#define __field_ecount_full_opt(size)
#define __field_ecount_opt(size)
#define __field_ecount_part(size,init)
#define __field_ecount_part_opt(size,init)
#define __field_range(lb,ub)
#define __field_xcount(size)
#define __field_xcount_full(size)
#define __field_xcount_full_opt(size)
#define __field_xcount_opt(size)
#define __field_xcount_part(size,init)
#define __field_xcount_part_opt(size,init)
#define __format_string
#define __inn
#define __in_bcount(size)
#define __in_bcount_nz(size)
#define __in_bcount_nz_opt(size)
#define __in_bcount_opt(size)
#define __in_bcount_z(size)
#define __in_bcount_z_opt(size)
#define __in_bound 
#define __in_ecount(size)
#define __in_ecount_nz(size)
#define __in_ecount_nz_opt(size)
#define __in_ecount_opt(size)
#define __in_ecount_z(size)
#define __in_ecount_z_opt(size)
#define __in_nz 
#define __in_nz_opt 
#define __in_opt 
#define __in_range(lb,ub)
#define __in_xcount(size)
#define __in_xcount_opt(size)
#define __in_z 
#define __in_z_opt 
#define __inexpressible_readableTo(size)
#define __inexpressible_writableTo(size)
#define __inner_allocator
#define __inner_assume_bound(i)
#define __inner_assume_bound_dec
#define __inner_bound
#define __inner_range(lb,ub)
#define __inout 
#define __inout_bcount(size)
#define __inout_bcount_full(size)
#define __inout_bcount_full_opt(size)
#define __inout_bcount_nz(size)
#define __inout_bcount_nz_opt(size)
#define __inout_bcount_opt(size)
#define __inout_bcount_part(size,length)
#define __inout_bcount_part_opt(size,length)
#define __inout_bcount_z(size)
#define __inout_bcount_z_opt(size)
#define __inout_ecount(size)
#define __inout_ecount_full(size)
#define __inout_ecount_full_opt(size)
#define __inout_ecount_nz(size)
#define __inout_ecount_nz_opt(size)
#define __inout_ecount_opt(size)
#define __inout_ecount_part(size,length)
#define __inout_ecount_part_opt(size,length)
#define __inout_ecount_z(size)
#define __inout_ecount_z_opt(size)
#define __inout_nz 
#define __inout_nz_opt 
#define __inout_opt 
#define __inout_xcount(size)
#define __inout_xcount_full(size)
#define __inout_xcount_full_opt(size)
#define __inout_xcount_opt(size)
#define __inout_xcount_opt(size)
#define __inout_xcount_part(size,length)
#define __inout_xcount_part_opt(size,length)
#define __inout_z 
#define __inout_z_opt 
#define __nullnullterminated
#define __nullterminated 
#define __outt
#define __out_bcount(size)
#define __out_bcount_full(size)
#define __out_bcount_full_opt(size)
#define __out_bcount_full_z(size)
#define __out_bcount_full_z_opt(size)
#define __out_bcount_nz(size)
#define __out_bcount_nz_opt(size)
#define __out_bcount_opt(size)
#define __out_bcount_part(size,length)
#define __out_bcount_part_opt(size,length)
#define __out_bcount_part_z(size,length)
#define __out_bcount_part_z_opt(size,length)
#define __out_bcount_z(size)
#define __out_bcount_z_opt(size)
#define __out_bound 
#define __out_ecount(size)
#define __out_ecount_full(size)
#define __out_ecount_full_opt(size)
#define __out_ecount_full_z(size)
#define __out_ecount_full_z_opt(size)
#define __out_ecount_nz(size)
#define __out_ecount_nz_opt(size)
#define __out_ecount_opt(size)
#define __out_ecount_part(size,length)
#define __out_ecount_part_opt(size,length)
#define __out_ecount_part_z(size,length)
#define __out_ecount_part_z_opt(size,length)
#define __out_ecount_z(size)
#define __out_ecount_z_opt(size)
#define __out_nz 
#define __out_nz_opt 
#define __out_opt 
#define __out_range(lb,ub)
#define __out_xcount(size)
#define __out_xcount_full(size)
#define __out_xcount_full_opt(size)
#define __out_xcount_opt(size)
#define __out_xcount_part(size,length)
#define __out_xcount_part_opt(size,length)
#define __out_z 
#define __out_z_opt 
#define __override 
#define __range(lb,ub)
#define __reserved 
#define __sql_escaped_and_delimited_right_bracket
#define __struct_bcount(size)
#define __struct_xcount(size)
#define __success(expr)
#define __transfer(formal)
#define __typefix(ctype)
#define __xcount(size)
#define __xcount_opt(size)
#define _Analysis_assume_
#define _Check_return_
#define _Check_return_
#define _Deref
#define _Deref_in_bound_
#define _Deref_in_range_(lb,ub)
#define _Deref_inout_bound_
#define _Deref_inout_z_
#define _Deref_inout_z_bytecap_c_(size)
#define _Deref_inout_z_cap_c_(size)
#define _Deref_opt_out_
#define _Deref_opt_out_opt_
#define _Deref_opt_out_opt_z_
#define _Deref_opt_out_z_
#define _Deref_out_
#define _Deref_out_bound_
#define _Deref_out_opt_
#define _Deref_out_opt_z_
#define _Deref_out_range_(lb,ub)
#define _Deref_out_z_
#define _Deref_out_z_bytecap_c_(size)
#define _Deref_out_z_cap_c_(size)
#define _Deref_post_bytecap_(size)
#define _Deref_post_bytecap_c_(size)
#define _Deref_post_bytecap_x_(size)
#define _Deref_post_bytecount_(size)
#define _Deref_post_bytecount_c_(size)
#define _Deref_post_bytecount_x_(size)
#define _Deref_post_cap_(size)
#define _Deref_post_cap_c_(size)
#define _Deref_post_cap_x_(size)
#define _Deref_post_count_(size)
#define _Deref_post_count_c_(size)
#define _Deref_post_count_x_(size)
#define _Deref_post_maybenull_
#define _Deref_post_notnull_
#define _Deref_post_null_
#define _Deref_post_opt_bytecap_(size)
#define _Deref_post_opt_bytecap_c_(size)
#define _Deref_post_opt_bytecap_x_(size)
#define _Deref_post_opt_bytecount_(size)
#define _Deref_post_opt_bytecount_c_(size)
#define _Deref_post_opt_bytecount_x_(size)
#define _Deref_post_opt_cap_(size)
#define _Deref_post_opt_cap_c_(size)
#define _Deref_post_opt_cap_x_(size)
#define _Deref_post_opt_count_(size)
#define _Deref_post_opt_count_c_(size)
#define _Deref_post_opt_count_x_(size)
#define _Deref_post_opt_valid_
#define _Deref_post_opt_valid_bytecap_(size)
#define _Deref_post_opt_valid_bytecap_c_(size)
#define _Deref_post_opt_valid_bytecap_x_(size)
#define _Deref_post_opt_valid_cap_(size)
#define _Deref_post_opt_valid_cap_c_(size)
#define _Deref_post_opt_valid_cap_x_(size)
#define _Deref_post_opt_z_
#define _Deref_post_opt_z_bytecap_(size)
#define _Deref_post_opt_z_bytecap_c_(size)
#define _Deref_post_opt_z_bytecap_x_(size)
#define _Deref_post_opt_z_cap_(size)
#define _Deref_post_opt_z_cap_c_(size)
#define _Deref_post_opt_z_cap_x_(size)
#define _Deref_post_valid_
#define _Deref_post_valid_bytecap_(size)
#define _Deref_post_valid_bytecap_c_(size)
#define _Deref_post_valid_bytecap_x_(size)
#define _Deref_post_valid_cap_(size)
#define _Deref_post_valid_cap_c_(size)
#define _Deref_post_valid_cap_x_(size)
#define _Deref_post_z_
#define _Deref_post_z_
#define _Deref_post_z_bytecap_(size)
#define _Deref_post_z_bytecap_c_(size)
#define _Deref_post_z_bytecap_x_(size)
#define _Deref_post_z_cap_(size)
#define _Deref_post_z_cap_c_(size)
#define _Deref_post_z_cap_x_(size)
#define _Deref_pre_bytecap_(size)
#define _Deref_pre_bytecap_c_(size)
#define _Deref_pre_bytecap_x_(size)
#define _Deref_pre_bytecount_(size)
#define _Deref_pre_bytecount_c_(size)
#define _Deref_pre_bytecount_x_(size)
#define _Deref_pre_cap_(size)
#define _Deref_pre_cap_c_(size)
#define _Deref_pre_cap_x_(size)
#define _Deref_pre_count_(size)
#define _Deref_pre_count_c_(size)
#define _Deref_pre_count_x_(size)
#define _Deref_pre_invalid_
#define _Deref_pre_maybenull_
#define _Deref_pre_notnull_
#define _Deref_pre_null_
#define _Deref_pre_opt_bytecap_(size)
#define _Deref_pre_opt_bytecap_c_(size)
#define _Deref_pre_opt_bytecap_x_(size)
#define _Deref_pre_opt_bytecount_(size)
#define _Deref_pre_opt_bytecount_c_(size)
#define _Deref_pre_opt_bytecount_x_(size)
#define _Deref_pre_opt_cap_(size)
#define _Deref_pre_opt_cap_c_(size)
#define _Deref_pre_opt_cap_x_(size)
#define _Deref_pre_opt_count_(size)
#define _Deref_pre_opt_count_c_(size)
#define _Deref_pre_opt_count_x_(size)
#define _Deref_pre_opt_valid_
#define _Deref_pre_opt_valid_bytecap_(size)
#define _Deref_pre_opt_valid_bytecap_c_(size)
#define _Deref_pre_opt_valid_bytecap_x_(size)
#define _Deref_pre_opt_valid_cap_(size)
#define _Deref_pre_opt_valid_cap_c_(size)
#define _Deref_pre_opt_valid_cap_x_(size)
#define _Deref_pre_opt_z_
#define _Deref_pre_opt_z_bytecap_(size)
#define _Deref_pre_opt_z_bytecap_c_(size)
#define _Deref_pre_opt_z_bytecap_x_(size)
#define _Deref_pre_opt_z_cap_(size)
#define _Deref_pre_opt_z_cap_c_(size)
#define _Deref_pre_opt_z_cap_x_(size)
#define _Deref_pre_readonly_
#define _Deref_pre_valid_
#define _Deref_pre_valid_bytecap_(size)
#define _Deref_pre_valid_bytecap_c_(size)
#define _Deref_pre_valid_bytecap_x_(size)
#define _Deref_pre_valid_cap_(size)
#define _Deref_pre_valid_cap_c_(size)
#define _Deref_pre_valid_cap_x_(size)
#define _Deref_pre_writeonly_
#define _Deref_pre_z_
#define _Deref_pre_z_bytecap_(size)
#define _Deref_pre_z_bytecap_c_(size)
#define _Deref_pre_z_bytecap_x_(size)
#define _Deref_pre_z_cap_(size)
#define _Deref_pre_z_cap_c_(size)
#define _Deref_pre_z_cap_x_(size)
#define _Deref_prepost_bytecap_(size)
#define _Deref_prepost_bytecap_x_(size)
#define _Deref_prepost_bytecount_(size)
#define _Deref_prepost_bytecount_x_(size)
#define _Deref_prepost_cap_(size)
#define _Deref_prepost_cap_x_(size)
#define _Deref_prepost_count_(size)
#define _Deref_prepost_count_x_(size)
#define _Deref_prepost_opt_bytecap_(size)
#define _Deref_prepost_opt_bytecap_x_(size)
#define _Deref_prepost_opt_bytecount_(size)
#define _Deref_prepost_opt_bytecount_x_(size)
#define _Deref_prepost_opt_cap_(size)
#define _Deref_prepost_opt_cap_x_(size)
#define _Deref_prepost_opt_count_(size)
#define _Deref_prepost_opt_count_x_(size)
#define _Deref_prepost_opt_valid_
#define _Deref_prepost_opt_valid_bytecap_(size)
#define _Deref_prepost_opt_valid_bytecap_x_(size)
#define _Deref_prepost_opt_valid_cap_(size)
#define _Deref_prepost_opt_valid_cap_x_(size)
#define _Deref_prepost_opt_z_
#define _Deref_prepost_opt_z_bytecap_(size)
#define _Deref_prepost_opt_z_cap_(size)
#define _Deref_prepost_valid_
#define _Deref_prepost_valid_bytecap_(size)
#define _Deref_prepost_valid_bytecap_x_(size)
#define _Deref_prepost_valid_cap_(size)
#define _Deref_prepost_valid_cap_x_(size)
#define _Deref_prepost_z_
#define _Deref_prepost_z_bytecap_(size)
#define _Deref_prepost_z_cap_(size)
#define _Deref_ret_bound_
#define _Deref_ret_opt_z_
#define _Deref_ret_range_(lb,ub)
#define _Deref_ret_z_
#define _FormatMessage_format_string_
#define _In_
#define _In_bound_
#define _In_bytecount_(size)
#define _In_bytecount_c_(size)
#define _In_bytecount_x_(size)
#define _In_count_(size)
#define _In_count_c_(size)
#define _In_count_x_(size)
#define _In_opt_
#define _In_opt_
#define _In_opt_bytecount_(size)
#define _In_opt_bytecount_c_(size)
#define _In_opt_bytecount_x_(size)
#define _In_opt_count_(size)
#define _In_opt_count_c_(size)
#define _In_opt_count_x_(size)
#define _In_opt_ptrdiff_count_(size)
#define _In_opt_z_
#define _In_opt_z_bytecount_(size)
#define _In_opt_z_bytecount_c_(size)
#define _In_opt_z_count_(size)
#define _In_opt_z_count_c_(size)
#define _In_ptrdiff_count_(size)
#define _In_range_(lb,ub)
#define _In_reads_(size)
#define _In_reads_bytes_(size)
#define _In_reads_bytes_opt_(size)
#define _In_z_
#define _In_z_bytecount_(size)
#define _In_z_bytecount_c_(size)
#define _In_z_count_(size)
#define _In_z_count_c_(size)
#define _Inout_
#define _Inout_bytecap_(size)
#define _Inout_bytecap_c_(size)
#define _Inout_bytecap_x_(size)
#define _Inout_bytecount_(size)
#define _Inout_bytecount_c_(size)
#define _Inout_bytecount_x_(size)
#define _Inout_cap_(size)
#define _Inout_cap_c_(size)
#define _Inout_cap_x_(size)
#define _Inout_count_(size)
#define _Inout_count_c_(size)
#define _Inout_count_x_(size)
#define _Inout_opt_
#define _Inout_opt_bytecap_(size)
#define _Inout_opt_bytecap_c_(size)
#define _Inout_opt_bytecap_x_(size)
#define _Inout_opt_bytecount_(size)
#define _Inout_opt_bytecount_c_(size)
#define _Inout_opt_bytecount_x_(size)
#define _Inout_opt_cap_(size)
#define _Inout_opt_cap_c_(size)
#define _Inout_opt_cap_x_(size)
#define _Inout_opt_count_(size)
#define _Inout_opt_count_c_(size)
#define _Inout_opt_count_x_(size)
#define _Inout_opt_ptrdiff_count_(size)
#define _Inout_opt_z_
#define _Inout_opt_z_bytecap_(size)
#define _Inout_opt_z_bytecap_c_(size)
#define _Inout_opt_z_bytecap_x_(size)
#define _Inout_opt_z_bytecount_(size)
#define _Inout_opt_z_bytecount_c_(size)
#define _Inout_opt_z_cap_(size)
#define _Inout_opt_z_cap_c_(size)
#define _Inout_opt_z_cap_x_(size)
#define _Inout_opt_z_count_(size)
#define _Inout_opt_z_count_c_(size)
#define _Inout_ptrdiff_count_(size)
#define _Inout_updates_(size)
#define _Inout_updates_bytes_(size)
#define _Inout_updates_bytes_to_(size,count)
#define _Inout_updates_z_(size)
#define _Inout_z_
#define _Inout_z_bytecap_(size)
#define _Inout_z_bytecap_c_(size)
#define _Inout_z_bytecap_x_(size)
#define _Inout_z_bytecount_(size)
#define _Inout_z_bytecount_c_(size)
#define _Inout_z_cap_(size)
#define _Inout_z_cap_c_(size)
#define _Inout_z_cap_x_(size)
#define _Inout_z_count_(size)
#define _Inout_z_count_c_(size)
#define _Out_
#define _Out_bound_
#define _Out_bytecap_(size)
#define _Out_bytecap_c_(size)
#define _Out_bytecap_post_bytecount_(cap,count)
#define _Out_bytecap_x_(size)
#define _Out_bytecapcount_(capcount)
#define _Out_bytecapcount_x_(capcount)
#define _Out_cap_(size)
#define _Out_cap_c_(size)
#define _Out_cap_m_(mult,size)
#define _Out_cap_post_count_(cap,count)
#define _Out_cap_x_(size)
#define _Out_capcount_(capcount)
#define _Out_capcount_x_(capcount)
#define _Out_opt_
#define _Out_opt_bytecap_(size)
#define _Out_opt_bytecap_c_(size)
#define _Out_opt_bytecap_post_bytecount_(cap,count)
#define _Out_opt_bytecap_x_(size)
#define _Out_opt_bytecapcount_(capcount)
#define _Out_opt_bytecapcount_x_(capcount)
#define _Out_opt_cap_(size)
#define _Out_opt_cap_c_(size)
#define _Out_opt_cap_m_(mult,size)
#define _Out_opt_cap_post_count_(cap,count)
#define _Out_opt_cap_x_(size)
#define _Out_opt_capcount_(capcount)
#define _Out_opt_capcount_x_(capcount)
#define _Out_opt_ptrdiff_cap_(size)
#define _Out_opt_z_bytecap_(size)
#define _Out_opt_z_bytecap_c_(size)
#define _Out_opt_z_bytecap_post_bytecount_(cap,count)
#define _Out_opt_z_bytecap_x_(size)
#define _Out_opt_z_bytecapcount_(capcount)
#define _Out_opt_z_cap_(size)
#define _Out_opt_z_cap_c_(size)
#define _Out_opt_z_cap_m_(mult,size)
#define _Out_opt_z_cap_post_count_(cap,count)
#define _Out_opt_z_cap_x_(size)
#define _Out_opt_z_capcount_(capcount)
#define _Out_ptrdiff_cap_(size)
#define _Out_range_(lb,ub)
#define _Out_writes_(size)
#define _Out_writes_bytes_(count)
#define _Out_writes_bytes_opt_(size)
#define _Out_writes_bytes_to_opt_(size,count)
#define _Out_writes_opt_(size)
#define _Out_writes_z_(size)
#define _Out_z_bytecap_(size)
#define _Out_z_bytecap_c_(size)
#define _Out_z_bytecap_post_bytecount_(cap,count)
#define _Out_z_bytecap_x_(size)
#define _Out_z_bytecapcount_(capcount)
#define _Out_z_cap_(size)
#define _Out_z_cap_c_(size)
#define _Out_z_cap_m_(mult,size)
#define _Out_z_cap_post_count_(cap,count)
#define _Out_z_cap_x_(size)
#define _Out_z_capcount_(capcount)
#define _Outptr_result_buffer_(size)
#define _Outref_result_bytebuffer_maybenull_(size)
#define _Outref_result_maybenull_
#define _Post_bytecap_(size)
#define _Post_bytecount_(size)
#define _Post_bytecount_c_(size)
#define _Post_bytecount_x_(size)
#define _Post_cap_(size)
#define _Post_count_(size)
#define _Post_count_c_(size)
#define _Post_count_x_(size)
#define _Post_invalid_
#define _Post_maybez_
#define _Post_notnull_
#define _Post_ptr_invalid_
#define _Post_valid_
#define _Post_z_
#define _Post_z_bytecount_(size)
#define _Post_z_bytecount_c_(size)
#define _Post_z_bytecount_x_(size)
#define _Post_z_count_(size)
#define _Post_z_count_c_(size)
#define _Post_z_count_x_(size)
#define _Pre_bytecap_(size)
#define _Pre_bytecap_c_(size)
#define _Pre_bytecap_x_(size)
#define _Pre_bytecount_(size)
#define _Pre_bytecount_c_(size)
#define _Pre_bytecount_x_(size)
#define _Pre_cap_(size)
#define _Pre_cap_c_(size)
#define _Pre_cap_for_(param)
#define _Pre_cap_m_(mult,size)
#define _Pre_cap_x_(size)
#define _Pre_count_(size)
#define _Pre_count_c_(size)
#define _Pre_count_x_(size)
#define _Pre_invalid_
#define _Pre_maybenull_
#define _Pre_notnull_
#define _Pre_null_
#define _Pre_opt_bytecap_(size)
#define _Pre_opt_bytecap_c_(size)
#define _Pre_opt_bytecap_x_(size)
#define _Pre_opt_bytecount_(size)
#define _Pre_opt_bytecount_c_(size)
#define _Pre_opt_bytecount_x_(size)
#define _Pre_opt_cap_(size)
#define _Pre_opt_cap_c_(size)
#define _Pre_opt_cap_for_(param)
#define _Pre_opt_cap_m_(mult,size)
#define _Pre_opt_cap_x_(size)
#define _Pre_opt_count_(size)
#define _Pre_opt_count_c_(size)
#define _Pre_opt_count_x_(size)
#define _Pre_opt_ptrdiff_cap_(ptr)
#define _Pre_opt_ptrdiff_count_(ptr)
#define _Pre_opt_valid_
#define _Pre_opt_valid_bytecap_(size)
#define _Pre_opt_valid_bytecap_c_(size)
#define _Pre_opt_valid_bytecap_x_(size)
#define _Pre_opt_valid_cap_(size)
#define _Pre_opt_valid_cap_c_(size)
#define _Pre_opt_valid_cap_x_(size)
#define _Pre_opt_z_
#define _Pre_opt_z_bytecap_(size)
#define _Pre_opt_z_bytecap_c_(size)
#define _Pre_opt_z_bytecap_x_(size)
#define _Pre_opt_z_cap_(size)
#define _Pre_opt_z_cap_c_(size)
#define _Pre_opt_z_cap_x_(size)
#define _Pre_ptrdiff_cap_(ptr)
#define _Pre_ptrdiff_count_(ptr)
#define _Pre_readonly_
#define _Pre_valid_
#define _Pre_valid_bytecap_(size)
#define _Pre_valid_bytecap_c_(size)
#define _Pre_valid_bytecap_x_(size)
#define _Pre_valid_cap_(size)
#define _Pre_valid_cap_c_(size)
#define _Pre_valid_cap_x_(size)
#define _Pre_writeonly_
#define _Pre_z_
#define _Pre_z_bytecap_(size)
#define _Pre_z_bytecap_c_(size)
#define _Pre_z_bytecap_x_(size)
#define _Pre_z_cap_(size)
#define _Pre_z_cap_c_(size)
#define _Pre_z_cap_x_(size)
#define _Prepost_bytecount_(size)
#define _Prepost_bytecount_c_(size)
#define _Prepost_bytecount_x_(size)
#define _Prepost_count_(size)
#define _Prepost_count_c_(size)
#define _Prepost_count_x_(size)
#define _Prepost_opt_bytecount_(size)
#define _Prepost_opt_bytecount_c_(size)
#define _Prepost_opt_bytecount_x_(size)
#define _Prepost_opt_count_(size)
#define _Prepost_opt_count_c_(size)
#define _Prepost_opt_count_x_(size)
#define _Prepost_opt_valid_
#define _Prepost_opt_z_
#define _Prepost_valid_
#define _Prepost_z_
#define _Printf_format_string_
#define _Ret_
#define _Ret_bound_
#define _Ret_bytecap_(size)
#define _Ret_bytecap_c_(size)
#define _Ret_bytecap_x_(size)
#define _Ret_bytecount_(size)
#define _Ret_bytecount_c_(size)
#define _Ret_bytecount_x_(size)
#define _Ret_cap_(size)
#define _Ret_cap_c_(size)
#define _Ret_cap_x_(size)
#define _Ret_count_(size)
#define _Ret_count_c_(size)
#define _Ret_count_x_(size)
#define _Ret_maybenull_
#define _Ret_notnull_
#define _Ret_null_
#define _Ret_opt_
#define _Ret_opt_
#define _Ret_opt_bytecap_(size)
#define _Ret_opt_bytecap_c_(size)
#define _Ret_opt_bytecap_x_(size)
#define _Ret_opt_bytecount_(size)
#define _Ret_opt_bytecount_c_(size)
#define _Ret_opt_bytecount_x_(size)
#define _Ret_opt_cap_(size)
#define _Ret_opt_cap_c_(size)
#define _Ret_opt_cap_x_(size)
#define _Ret_opt_count_(size)
#define _Ret_opt_count_c_(size)
#define _Ret_opt_count_x_(size)
#define _Ret_opt_valid_
#define _Ret_opt_z_
#define _Ret_opt_z_
#define _Ret_opt_z_bytecap_(size)
#define _Ret_opt_z_bytecount_(size)
#define _Ret_opt_z_cap_(size)
#define _Ret_opt_z_count_(size)
#define _Ret_range_(lb,ub)
#define _Ret_valid_
#define _Ret_z_
#define _Ret_z_
#define _Ret_z_bytecap_(size)
#define _Ret_z_bytecount_(size)
#define _Ret_z_cap_(size)
#define _Ret_z_count_(size)
#define _Scanf_format_string_
#define _Scanf_s_format_string_
#define _Success_(expr)
#define _Outptr_
#define _Notnull_

#endif // XPLAT_SAL_DEFINED

